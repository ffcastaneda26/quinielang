-- Asigna a todos los usuarios clave= password
UPDATE users SET password='$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

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
ORDER BY ga.game_date;


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
ORDER BY ga.game_date;

--
SELECT ga.id AS 'Juego Id',
		us.alias  nombre,
		tv.name AS 'Visita',
		ga.visit_points AS 'Puntos Visita',
		tl.name AS 'Local',
		ga.local_points AS 'Puntos Local',
		if(pic.winner = 1,'Local','Visita')  AS 'Pronosticado',
		if(ga.winner = 1,tl.name,tv.name)  AS 'Ganador',
		if(ga.winner = pic.winner,'SI','NO') AS '¿Acerto?',
		if(pic.hit_last_game,'SI','NO') AS 'Acertó Último'
FROM users us,games ga,teams tv,teams tl,picks pic
WHERE us.id = pic.user_id
  AND tv.id = ga.visit_team_id
  AND tl.id = ga.local_team_id
  AND ga.id = pic.game_id
  AND us.id = 2
  AND ga.round_id = 1
ORDER BY ga.game_date;


-- Posiciones x Jornada
SELECT us.alias
FROM users us,positions pxj
WHERE us.id = pxj.user_id
  AND us.alias LIKE '%%'
ORDER BY us.alias

SELECT po.position,us.alias,po.hits,po.dif_total_points
FROM users us,positions po
WHERE us.id = po.user_id
  AND round_id = 1
ORDER BY po.hits DESC,
         po.hit_last_game DESC,
         dif_total_points,
         po.dif_local_points,
         po.dif_visit_points,
         po.dif_winner_points,
         po.dif_vict

-- Partidos
SELECT
    ga.round_id AS JORNADA,
    ga.game_date AS FECHA,
    tv.name AS VISITA,
      COALESCE(ga.visit_points, '') AS 'PUNTOS',
    tl.name AS LOCAL,
    COALESCE(ga.local_points, '') AS 'PTOS LOCAL',
    CASE
        WHEN ga.winner = 1 THEN 'LOCAL'
        WHEN ga.winner = 2 THEN 'VISITA'
        ELSE 'PENDIENTE'
    END AS GANADOR
FROM
    games ga
INNER JOIN teams tv ON tv.id = ga.visit_team_id
INNER JOIN teams tl ON tl.id = ga.local_team_id
ORDER BY ga.game_date;
