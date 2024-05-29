-- Partidos de una jornada
USE quinielang;
SELECT ga.id,
 	DATE_FORMAT(	ga.game_date, "%d-%M-%Y %H:%i:%s") as FECHA,
	tv.name AS VISITANTE,
	ga.visit_points AS MVISITA,
	tl.name AS LOCAL,
	ga.local_points AS MLOCAL,
	CASE ga.winner
           WHEN 1 THEN 'LOCAL'
           WHEN 2 THEN 'VISITA'
       END AS GANADOR
FROM games ga,teams tv,teams tl
WHERE tv.id = ga.visit_team_id
  AND tl.id = ga.local_team_id
  AND ga.round_id = 1
ORDER BY ga.game_date

-- Pronósticos de usuario y si acertó o no
USE quinielang;
SELECT ga.id AS 'Juego Id',
		-- us.name  nombre,
		tv.name AS 'Visita',
		ga.visit_points AS 'Puntos Visita',
		tl.name AS 'Local',
		ga.local_points AS 'Puntos Local',
		if(pic.winner = 1,'Local','Visita')  AS 'Ganador Pronosticado',
		if(ga.winner = 1,tl.name,tv.name)  AS 'Ganador Partido',
		if(ga.winner = pic.winner,'SI','NO') AS 'Acerto Partido',
		if(pic.hit_last_game,'SI','NO') AS 'Acertó Último'
FROM users us,games ga,teams tv,teams tl,picks pic
WHERE us.id = pic.user_id
  AND tv.id = ga.visit_team_id
  AND tl.id = ga.local_team_id
  AND ga.id = pic.game_id
  AND us.id = 2
  AND ga.round_id = 1
  AND ga.id = 16
ORDER BY ga.game_day,ga.game_time;


-----------
USE quinielang;
SELECT ga.id AS 'Juego Id',
		us.name  nombre,
		tv.name AS 'Visita',
		ga.visit_points AS 'Puntos Visita',
		tl.name AS 'Local',
		ga.local_points AS 'Puntos Local',
		if(pic.winner = 1,'Local','Visita')  AS 'Ganador Pronosticado',
		if(ga.winner = 1,tl.name,tv.name)  AS 'Ganador Partido',
		if(ga.winner = pic.winner,'SI','NO') AS 'Acerto Partido',
		if(pic.hit_last_game,'SI','NO') AS 'Acertó Último'
FROM users us,games ga,teams tv,teams tl,picks pic
WHERE us.id = pic.user_id
  AND tv.id = ga.visit_team_id
  AND tl.id = ga.local_team_id
  AND ga.id = pic.game_id
  AND us.id = 2
  AND ga.round_id = 1
  AND ga.id = 16
ORDER BY ga.game_day,ga.game_time;
