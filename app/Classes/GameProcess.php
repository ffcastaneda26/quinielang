<?php

namespace App\Classes;

use Exception;
use Throwable;
use App\Models\Game;
use App\Models\Pick;
use App\Models\User;
use App\Models\Round;
use App\Models\Position;

use App\Models\GeneralPosition;
use App\Models\UserSurvivor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

use function PHPUnit\Framework\returnValue;

class GameProcess
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /** Califica Pronósticos */
    public function qualify_picks()
    {
        try {
            Pick::join('games', 'games.id', '=', 'picks.game_id')
                ->update([
                    'picks.hit_game' => DB::raw('CASE WHEN picks.winner = games.winner THEN 1 ELSE 0 END')
                ]);
        } catch (Exception $e) {
            Log::error($e);
            dd('Error en qualify_picks : ' . $e->getMessage() . ' Avise al Administrador');
        } catch (Throwable $t) {
            dd('Error en qualify_picks : ' . $t->getMessage() . ' Avise al Administrador');
            Log::error($t);
        }

    }

    /** Actualiza en pronósticos campo: hit_last_game */
    public function update_hit_last_game(Game $game)
    {
        try {
            $sql = "UPDATE picks pic,games ga ";
            $sql .= "SET hit_last_game= CASE WHEN pic.winner=ga.winner THEN 1 ELSE 0 END ";
            $sql .= "WHERE ga.id = pic.game_id ";
            $sql .= "  AND ga.visit_points IS NOT NULL ";
            $sql .= "  AND ga.local_points IS NOT NULL ";
            $sql .= "  AND ga.id=" . $game->id;
            return DB::update($sql);
        } catch (Exception $e) {
            Log::error($e);
            dd('Error en update_hit_last_game : ' . $e->getMessage() . ' Avise al Administrador');
        } catch (Throwable $t) {
            dd('Error en update_hit_last_game : ' . $t->getMessage() . ' Avise al Administrador');
            Log::error($t);
        }



    }

    // Actualia criterios de desempate
    public function update_tie_breaker(Game $game)
    {
        try {
            $sql = "UPDATE picks ";
            $sql .= "SET dif_points_winner=NULL,";
            $sql .= "dif_points_total=NULL,";
            $sql .= "dif_points_local=NULL,";
            $sql .= "dif_points_visit=NULL,";
            $sql .= "hit_local=0,";
            $sql .= "hit_visit=0,";
            $sql .= "hit_last_game=0,";
            $sql .= "dif_victory=NULL ";
            DB::update($sql);

            $dif_victoria = $game->local_points + $game->visit_points;
            $sql = "UPDATE picks pic,games ga ";
            $sql .= "SET ";
            $sql .= "dif_points_winner= CASE WHEN (" . $game->local_points . ">" . $game->visit_points . ") THEN abs(pic.local_points - " . $game->local_points . ") ELSE abs(pic.visit_points - " . $game->visit_points . ")  END,";
            $sql .= "pic.dif_points_total= abs(abs(" . $game->visit_points . "-pic.visit_points)+abs(" . $game->local_points . "-pic.local_points)),";
            $sql .= "pic.dif_points_local=abs(" . $game->local_points . "-pic.local_points),";
            $sql .= "pic.dif_points_visit= abs(" . $game->visit_points . "-pic.visit_points),";
            $sql .= "hit_local= CASE WHEN pic.local_points=" . $game->local_points . " THEN 1 ELSE 0  END,";
            $sql .= "hit_visit= CASE WHEN pic.visit_points=" . $game->visit_points . " THEN 1 ELSE 0  END,";
            $sql .= "hit_last_game= CASE WHEN pic.winner=ga.winner THEN 1 ELSE 0 END,";
            $sql .= "pic.dif_victory=abs(" . $dif_victoria . "-(pic.local_points + pic.visit_points)) ";
            $sql .= "WHERE ga.id = pic.game_id ";
            $sql .= "  AND ga.id=" . $game->id;
            return DB::update($sql);
        } catch (Exception $e) {
            Log::error($e);
            dd('Error en update_tie_breaker : ' . $e->getMessage() . ' Avise al Administrador');
        } catch (Throwable $t) {
            dd('Error en update_tie_breaker : ' . $t->getMessage() . ' Avise al Administrador');
            Log::error($t);
        }

    }

    public function update_positions_round($round_id)
    {
        $this->clear_position_attributes($round_id);
        $this->update_total_hits_positions($round_id);
        $this->update_position_in_round($round_id);
        $this->update_general_positions();
    }

    // Limpia campos de la tabla de POSITIONS de la jornada
    private function clear_position_attributes($round_id)
    {
        try {
            $sql = "UPDATE positions ";
            $sql .= "SET hits=null,";
            $sql .= "extra_points=NULL,";
            $sql .= "dif_winner_points=NULL,";
            $sql .= "dif_total_points=NULL,";
            $sql .= "dif_local_points=NULL,";
            $sql .= "dif_visit_points=NULL,";
            $sql .= "dif_victory=NULL,";
            $sql .= "hit_last_game=0,";
            $sql .= "hit_visit=0,";
            $sql .= "hit_local=0,";
            $sql .= "position=null";
            $sql .= " WHERE round_id=" . $round_id;
            DB::update($sql);
        } catch (Exception $e) {
            Log::error($e);
            dd('Error en clear_position_attributes : ' . $e->getMessage() . ' Avise al Administrador');
        } catch (Throwable $t) {
            dd('Error en clear_position_attributes : ' . $t->getMessage() . ' Avise al Administrador');
            Log::error($t);
        }

    }

    // Actualiza la tabla de POSICIONES de la jornada
    /**
     * 1) Lee de manera sumarizada los pronósticos de la jornada por usuario
     * 2) Recorre los pronósticos sumarizados y por cada uno:
     *      a) Si no tiene el registro en tabla POSITIONS con jornada y usuario lo crea
     *      b) Actualiza la tabla de posiciones de la jornada y usuario
     *
     */
    private function update_total_hits_positions($round_id)
    {
        $picks_to_positions = $this->read_totals_picks($round_id);

        if ($picks_to_positions->count()) {
            foreach ($picks_to_positions as $pick_to_position) {
                $user = User::findOrFail($pick_to_position->user_id);
                $this->update_position_round_user($user, $round_id, $pick_to_position);
            }
        }
    }

    // Suma pronósticos de la jornada por Usuario
    private function read_totals_picks($round_id)
    {
        return User::role(env('ROLE_PARTICIPANT', 'Participante'))
            ->select(
                'users.id as user_id',
                DB::raw('SUM(picks.hit_game) as hits'),
                DB::raw('SUM(picks.dif_points_total) as dif_total_points'),
                DB::raw('SUM(picks.dif_points_local) as dif_local_points'),
                DB::raw('SUM(picks.dif_points_visit) as dif_visit_points'),
                DB::raw('SUM(picks.dif_points_winner) as dif_winner_points'),
                DB::raw('SUM(picks.dif_victory) as dif_victory'),
                DB::raw('SUM(picks.hit_last_game) as hit_last_game'),
                DB::raw('SUM(picks.hit_local) as hit_local'),
                DB::raw('SUM(picks.hit_visit) as hit_visit')
            )
            ->Join('picks', 'picks.user_id', '=', 'users.id')
            ->Join('games', 'picks.game_id', '=', 'games.id')
            ->where('games.round_id', $round_id)
            ->where('users.active', '1')
            ->groupBy('users.id')
            ->get();
    }


    // Actualiza la tabla de POSICIONES
    private function update_position_round_user($user, $round_id, $pick_to_position)
    {
        $position_record = $user->positions_round($round_id);
        if (!$position_record) {
            $position_record = Position::create([
                'round_id' => $round_id,
                'user_id' => $user->id
            ]);
        }

        $position_record->hits = $pick_to_position->hits;
        $position_record->extra_points = $pick_to_position->extra_points;
        $position_record->dif_winner_points = $pick_to_position->dif_winner_points;
        $position_record->dif_total_points = $pick_to_position->dif_total_points;
        $position_record->dif_local_points = $pick_to_position->dif_local_points;
        $position_record->dif_visit_points = $pick_to_position->dif_visit_points;
        $position_record->dif_victory = $pick_to_position->dif_victory;
        $position_record->hit_last_game = $pick_to_position->hit_last_game;
        $position_record->hit_visit = $pick_to_position->hit_visit;
        $position_record->hit_local = $pick_to_position->hit_local;
        $position_record->save();
    }

    private function create_position_round_user($round_id, $user_id)
    {
        return Position::create([
            'round_id' => $round_id,
            'user_id' => $user_id
        ]);
    }
    private function update_position_in_round($round_id)
    {
        $this->update_positions_to_null($round_id);

        $positions = Position::orderbyDesc('hits')
            ->orderby('dif_total_points')
            ->orderby('dif_local_points')
            ->orderby('dif_visit_points')
            ->orderbyDesc('hit_last_game')
            ->orderby('dif_winner_points')
            ->orderby('dif_victory')
            ->orderby('created_at')
            ->get();

        $i = 1;
        foreach ($positions as $position) {
            $position->position = $i++;
            $position->save();
        }
    }

    // Actualiza posiciones a NULL
    private function update_positions_to_null($round_id)
    {
        try {
            $sql = "UPDATE positions ";
            $sql .= "SET position=NULL ";
            $sql .= " WHERE round_id=" . $round_id;
            DB::update($sql);
        } catch (Exception $e) {
            Log::error($e);
            dd('Error en update_positions_to_null : ' . $e->getMessage() . ' Avise al Administrador');
        } catch (Throwable $t) {
            dd('Error en update_positions_to_null : ' . $t->getMessage() . ' Avise al Administrador');
            Log::error($t);
        }

    }

    private function update_general_positions()
    {
        try {
            $sum_positions = $this->sum_positions();

            if (!$sum_positions->count()) {
                return;
            }

            $position = 0;
            foreach ($sum_positions as $sum_position) {
                $position++;
                $general_position = GeneralPosition::where('user_id', $sum_position->user_id)->first();
                if (!$general_position) {
                    $this->create_general_position_record($sum_position, $position);
                } else {
                    $this->update_general_position_record($general_position, $sum_position, $position);
                }
            }
        } catch (Exception $e) {
            Log::error($e);
            dd('Error: en update_general_positions', $e->getMessage());
        }
    }
    // Crea registro en tabla de Posiciones Generales
    private function create_general_position_record($data, $position)
    {
        try {
            GeneralPosition::create([
                'user_id' => $data->user_id,
                'hits' => $data->hits,
                'hits_breaker' => $data->hits_last_game,
                'total_error' => $data->total_error,
                'position' => $position
            ]);
        } catch (Exception $e) {
            Log::error($e);
            dd('Error: en create_general_position_record' . $e->getMessage());
        } catch (Throwable $t) {
            echo "Error: en create_general_position_record" . $t->getMessage();
            // Log the throwable
            Log::error($t);
        }
    }
    // Actualiza registro en tabla de posiciones generales
    private function update_general_position_record(GeneralPosition $record, $data, $position)
    {
        try {
            $record->hits = $data->hits;
            $record->hits_breaker = $data->hits_last_game;
            $record->total_error = $data->total_error;
            $record->position = $position;
            $record->save();
        } catch (Exception $e) {
            Log::error($e);
            dd('Error: en update_general_position_record', $e->getMessage());
        }

    }

    // Suma la tabla de POSITIONS para tabla de posiciones generales
    private function sum_positions()
    {
        try {
            $sum_positions = Position::selectRaw('user_id,
                            SUM(hits) as hits,
                            SUM(hit_last_game) as hits_last_game,
                            SUM(dif_total_points) as total_error')
                ->groupBy('user_id')
                ->orderByDesc('hits')
                ->orderByDesc('hits_last_game')
                ->orderBy('total_error')
                ->get();
            return $sum_positions;
        } catch (Exception $e) {
            Log::error($e);
            dd('Error en sum_positions : ', $e->getMessage(), ' Avise al Administrador');
        }
    }

    public function qualify_survivors(Game $game)
    {
        try {
            $team_winner_id = $game->winner == 1 ? $game->local_team_id : $game->visit_team_id;
            UserSurvivor::join('rounds', 'rounds.id', '=', 'user_survivors.round_id')
                ->update([
                    'user_survivors.survive' => DB::raw('CASE WHEN user_survivors.team_id=' . $team_winner_id . ' THEN 1 ELSE 0 END')
                ]);
        } catch (Exception $e) {
            Log::error($e);
            dd('Error en qualify_survivors : ' . $e->getMessage() . ' Avise al Administrador');
        } catch (Throwable $t) {
            dd('Error en qualify_survivors : ' . $t->getMessage() . ' Avise al Administrador');
            Log::error($t);
        }

    }
}
