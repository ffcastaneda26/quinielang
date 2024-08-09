<link rel="stylesheet" href="{{ asset('css/marquee.css') }}">
<div
    class="p-6 lg:p-8 bg-white text-black">

    <div class="position-relative marquee-container d-none d-sm-block">
        <div class="marquee d-flex justify-content-around">
            <span class="z-10 bg-yellow-500 text-black text-center py-2">LAS REGLAS ESTÁN EN REVISION</span>
        </div>
    </div>

    <div class="bg-gray-100 text-black grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
        {{-- ¿Como se Juega? --}}
        <div>
            <div class="flex items-center">
                <img src="{{ asset('images/comojugar.png') }}" class="w-12">
                <h2 class="ms-3 text-2xl font-semibold text-black ">
                    ¿Cómo se juega?
                </h2>
            </div>

            <p class="mt-4 text-black text-xs leading-relaxed">
            <div>
                <ul class="list-disc">
                    <li>En la sección de "Pronósticos" Cada Partitipante selecciona entre Local y Visita pronosticando
                        al Ganador.</li>
                    <li>En el último partido de cada Jornada se pronostica Puntos Local y Puntos Visita (Partido
                        Desempate PD).</li>
                    <li>La Selección de Local/Visita del Partido Desempate cambia automáticamente después de guardar el
                        pronóstico de la jornada.</li>
                    <li>Cada pronóstico puede ser modificado hasta 5 minutos antes de la hora de inicio del partido.</li>
                    <li>Los pronósticos que han sido bloqueados para modificación simultáneamente se hacen visibles para
                        el resto de los participantes en "Tabla Pronósticos".</li>
                    <li>Gana quien más puntos obtengan al final de cada Jornada y/o toda la temporada (Acumulado).</li>
                </ul>
            </div>
            </p>
        </div>

        {{-- Puntuaciones --}}
        <div>
            <div class="flex items-center">
                <img src="{{ asset('images/puntuaciones.png') }}" class="w-12">
                <div>
                    <h3 class="ms-3 text-2xl font-semibold text-black ">
                        Puntuaciones
                    </h3>
                </div>
            </div>
            <div>
                <p class="mt-4 text-md font-semibold text-black">
                    Cada Partido donde se acierta al ganador genera puntos de la siguiente manera:
                </p>
            </div>

            <p class="mt-4 text-sm">
            <ul class="list-disc">
                <li>1 Punto. Partidos de Temporada Regular (272 Partidos).</li>
                <li>1 Punto. Partidos Playoff Ronda Comodines/Wildcard (6 Partidos).</li>
                <li>1 Punto. Partidos Playoff Ronda Divisional (4 Partidos).</li>
                <li>2 Puntos. Partidos Final de Conferencia NFC y AFC (2 Partidos).</li>
                <li>3 Puntos. Super Bowl (1 Partido)</li>
            </ul>
            <p class="ms-3 mt-2 text-md font-semibold text-black">
                Las puntuaciones aplican tanto en Jornada como Acumulado.
            </p>

            </p>
        </div>

        {{-- Premiaciones --}}
        <div>
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/premiaciones.png') }}" class="w-12">
                <h2 class="ms-3 text-xl font-semibold text-black ">
                    Premiaciones.
                </h2>
            </div>

            <p class="mt-4 text-black text-sm leading-relaxed">
            <ul class="list-disc">
                <li>Un Ganador por cada Jornada. (18 Temporada Regular + 1 de Playoffs J19).</li>
                <li>1°, 2° y 3° Lugar en el Acumulado de Toda la Temporada incluyendo Super Bowl.</li>
                <li>Survivor</li>
            </ul>
            </p>
        </div>

        {{-- Desempate Jornada --}}
        <div>
            <div class="flex items-center">
                <img src="{{ asset('images/criterios_desempate_jornada.png') }}" alt="Desempate" class="w-12">
                <h2 class="ms-3 text-xl font-semibold text-black ">
                    Criterios de Desempate en Jornada.
                </h2>
            </div>

            <p class="mt-4 ml-5 text-black text-sm leading-relaxed">
            <ul>
                <li>1. Mas Puntos en la Jornada incluido el partido de desempate.</li>
                <li>2. Acierto en el Partido desempate lleva ventaja sobre los que no.</li>
                <li>3. Menor Error Total del Partido Desempate. (Error Total = Error en Puntos Local + Error en Puntos
                    Visita).</li>
                <li>4. Menor Error en alguno de los 2 pronósticos Puntos Local o Puntos Visita.</li>
                <li>5. Menor Error en los puntos pronosticados al Ganador del Partido.</li>
                <li>6. Menor Error en el total de puntos del partido. (Local + Visita).</li>
                <li>7. Volado Virtual o división de premio entre empatados.</li>
            </ul>
            </p>
        </div>

        {{-- Desempate Acumulado --}}
        <div>
            <div class="flex items-center">
                <img src="{{ asset('images/criterios_desempate_acumulado.png') }}" alt="Desempate" class="w-12">
                <h2 class="ms-3 text-xl font-semibold text-black ">
                    Criterios de Desempate del Acumulado.
                </h2>
            </div>

            <p class="mt-4 ml-5 text-black text-sm leading-relaxed">
            <ul>
                <li>1. Más Puntos en toda la temporada.</li>
                <li>2. Más Puntos en los partidos de desempate (El SB Vale triple).</li>
                <li>3.Menor Error Total acumulado durante los 19 juegos de desempate. (Error Total Jornada 1 +
                    J2+J3...J19)
                    <br>
                    (Los primeros 3 criterios serán mostrados y calculados por sistema, de seguir en empate el orden
                    será desplegado alfabéticamente y calculados manualmente al finalizar la Temporada).
                </li>
                <li>4. Se aplican las reglas 2-6 de los criterios de Jornada empezando por el Superbowl, despues el
                    último de la semana 18, de seguir en empate se continúa con la 17 y asi sucesivamente hasta la
                    semana 1.</li>
                <li>5.Volado Virtual o división de premio(s) entre empatados.</li>
            </ul>
            </p>
        </div>

        {{-- Notas --}}
        <div>
            <div class="flex items-center">
                <img src="{{ asset('images/notas_comentarios.png') }}" class="w-12">
                <h2 class="ms-3 text-xl font-semibold text-black ">
                    Notas
                </h2>
            </div>

            <p class="mt-4 ml-5 text-black text-sm leading-relaxed">
            <ul class="list-disc">
                <li>Todos los Cálculos de Error en puntos son valores Absolutos.</li>
                <li>En caso de seguir empates tras aplicar los criterios, las bolsas de las posiciones empatadas se
                    repartiran entre el numero de participantes empatados.</li>
                <li>Si un partido termina empatado no genera puntos en la semana o acumulado, si un partido de desempate
                    termina en empate la regla 5 de Jornadas aplica a los puntos de local.</li>
                <li>Lo no contemplados dentro de los criterios quedarán sujeto a consideración del organizador.</li>
            </ul>
            </p>

            <div class="flex items-center">
                <img src="{{ asset('images/email.png') }}" class="w-12">
                <p class="mt-4 ml-50 text-sm/relaxed">
                    Si tiene algún problema, observación o sugerencia sobre el sitio, favor de
                    enviar un correo a nuestro <a href="mailto:luandeje@yahoo.com.mx"
                        class="underline font-extrabold">Webmaster</a>.
                </p>
            </div>

        </div>
        {{-- Cómo se juega el Survivor --}}
        <div>
            <div class="flex items-center">
                <img src="{{ asset('images/como_se_juega_survivor.png') }}" class="w-12">
                <h2 class="ms-3 text-xl font-semibold text-black ">
                    ¿Cómo se juega el Survivor?
                </h2>
            </div>

            <p class="mt-4 ml-5 text-black text-sm leading-relaxed">
                <ul class="list-disc">
                    <li>
                        En la sección de "Survivor" cada Partitipante seleccionará un equipo por Jornada (No se puede repetir equipo en toda la temporada).
                    </li>
                    <li>Si tu equipo seleccionado gana, "sobrevives" la Jornada y continuas con vida para la siguiente.</li>
                    <li>Si tu equipo seleccionado empata o pierde, no hiciste selección en la Jornada o duplicaste un equipo entonces quedas eliminado del premio Survivor y continuas participando como Zombie.</li>
                    <li>Cada Jornada los equipos estarán disponibles para selección cuando se cumplan los siguientes requisitos:</li>
                    <li>
                        <ul>
                            <li>a) El equipo tenga partido en la Jornada (No esté de descanso)</li>
                            <li>b) El Equipo No esté seleccionado en otra Jornada (anterior o futura)</li>
                            <li>c) El Partido no haya iniciado o esté a 5 minutos de iniciar.</li>
                            <li>d) La Jornada siga siendo editable.</li>
                        </ul>
                    </li>
                </ul>
            </p>

            <div class="flex items-center">
                <p class="mt-4 ml-50 font-bold italic">
                    *Los pronosticos survivor de cada Jornada se hacen simultaneamente visibles y no editables para todos los participantes cuando el primer partido de la Jornada en donde algún participante tenga equipo seleccionado esté a 5 minutos de iniciar.
                </p>
            </div>

        </div>

        {{-- Cómo se gana el Survivor --}}
        <div>
            <div class="flex items-center">
                <img src="{{ asset('images/como_se_gana_survivor.png') }}" class="w-12">
                <h2 class="ms-3 text-xl font-semibold text-black ">
                    ¿Cómo se Gana en el Survivor?
                </h2>
            </div>

            <p class="mt-4 ml-5 text-black text-sm leading-relaxed">
                <p>La competencia contempla que habrá al menos 2 premios y existen diferentes escenarios:</p>
                <ul class="list-disc">
                    <li>a) Ganador Survivor Único, si al terminar una Jornada existe un sólo sobreviviente se declara ganador Survivor y el resto participan por el premio de Zombies (2do Lugar). La ganancia del Survivor irá incrementando  cada jornada que siga como sobreviviente, el restante de la bolsa es para zombies (2do Lugar).</li>
                    <li>b) Ganadores Multi Survivor, si al termino de la Temporada Regular hay 2+ Sobrevivientes estos serán ganadores, el desempate se juega en playoffs y no hay premiación de Zombies.</li>
                    <li>c) Sin Ganador Survivor, si al término de una Jornada no hay sobrevivente todos los participantes compiten como Zombies. (Esto sucede cuando la jornada inicia con 2+ Sobrevivientes y termina sin sobrevivientes)</li>
                </ul>
            </p>

            <div class="flex items-center mt-4">
                <img src="{{ asset('images/zombies.png') }}" class="w-12">
                <h2 class="ms-3 text-xl font-semibold text-black ">
                    ¿Qué son los Zombies y cuando ganan?
                </h2>
            </div>
            <p class="flex items-center  mt-4 ml-5 text-black text-sm">
                <ul class="list-disc">
                    <li>Zombies son los participantes eliminados del Survivor, estos seguirán participando por el resto de la temporada y a la espera de que no haya Survivors Multiples para obtener premio.</li>
                    <li>Cada Jornada donde se acierta Ganador genera un punto, el Zombie con más puntos es el ganador y en caso de empate se siguen los siguientes criterios</li>
                    <div class="flex justify-end">
                        <ul style="list-style-type:decimal" class="ml-96">
                            <li>Participante que duró más Jornadas como sobreviviente.</li>
                            <li>Racha de victoria más larga después de hacerse zombie. (2da derrota)</li>
                            <li>Más equipos seleccionados Visitantes</li>
                        </ul>
                    </div>
                </ul>
            </p>



        </div>
    </div>

    <footer class="text-right font-bold">
        <p class="text-black bg-blue-900">Copyright &copy;
            <script>
                document.write(new Date().getFullYear());
            </script> Desarrollado por Excellsus Corp.
        </p>
    </footer>
</div>
