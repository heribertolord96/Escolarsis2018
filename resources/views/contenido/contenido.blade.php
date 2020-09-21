    @extends('principal')
    @section('contenido')
    @if(Auth::check())
            @if (Auth::user()->idrol == 1)
                <template v-if="menu==0">
                        <welcome ></welcome>
                    </template>
                <template v-if="menu==22">
                <categoria ></categoria>
                </template>

                <template v-if="menu==1">
                <cliente ></cliente>
                </template>

                <template v-if="menu==2">
                    <alumno ></alumno>
                </template>

                <template v-if="menu==3">
                    <materia ></materia>
                </template>

                <template v-if="menu==4">
                    <curso ></curso>
                </template>

                <template v-if="menu==5">
                    <sesion ></sesion>
                </template>
                <template v-if="menu==7">
                    <periodo ></periodo>
                </template>
                <template v-if="menu==8">
                    <user ></user>
                </template>

                <template v-if="menu==9">
                <rol ></rol>
                </template>

                <template v-if="menu==10">
                    <promedio ></promedio>
                </template>
                <template v-if="menu==13">
                    <promcurso ></promcurso>
                </template>
                <template v-if="menu==11">
                    <h1>Ayuda</h1>
                </template>
                
                <template v-if="menu==16">
                    <promcursochart ></promcursochart>
                </template>
                <template v-if="menu==17">
                    <matricula ></matricula>
                </template>
                <template v-if="menu==18">
                    <horario ></horario>
                </template>
                <template v-if="menu==19">
                    <cargaac ></cargaac>
                </template>

                <template v-if="menu==12">
                    <h1>Acerca de</h1>
                </template>
                <template v-if="menu==20">
                    <grupo ></grupo>
                </template>
                <template v-if="menu==21">
                    <reporte></reporte>
                </template>
            @elseif (Auth::user()->idrol == 2)
            <template v-if="menu==0">
                    <welcome ></welcome>
                </template>
                <template v-if="menu==22">
                <categoriamaster ></categoriamaster>
                </template>
                <template v-if="menu==2">
                    <alumno ></alumno>
                </template>

                <template v-if="menu==3">
                    <materia ></materia>
                </template>

                <template v-if="menu==4">
                    <cursoal ></cursoal>
                </template>

                <template v-if="menu==5">
                    <sesion ></sesion>
                </template>

                <template v-if="menu==6">
                    <sesionmaestro ></sesionmaestro>
                </template>

                <template v-if="menu==7">
                    <periodo ></periodo>
                </template>

                <template v-if="menu==8">
                    <usermaster ></usermaster>
                </template>
                <template v-if="menu==10">
                    <promedio ></promedio>
                </template>
                <template v-if="menu==13">
                    <promcurso ></promcurso>
                </template>
                <template v-if="menu==17">
                    <matricula ></matricula>
                </template>
                <template v-if="menu==18">
                    <horarioam ></horarioam>
                </template>
                <template v-if="menu==21">
                    <reporte></reporte>
                </template>
            @elseif (Auth::user()->idrol == 3)
            <template v-if="menu==0">
                    <welcome ></welcome>
                </template>
                <template v-if="menu==22">
                <categoriamaster ></categoriamaster>
                </template>

                <template v-if="menu==3">
                    <materiaal ></materiaal>
                </template>

                <template v-if="menu==4">
                    <cursoal ></cursoal>
                </template>

                <template v-if="menu==20">
                    <sesional ></sesional>
                </template>
                <template v-if="menu==7">
                    <periodoal ></periodoal>
                </template>
                <template v-if="menu==17">
                    <matricula ></matricula>
                </template>
                <template v-if="menu==8">
                    <useral ></useral>
                </template>
                <template v-if="menu==10">
                    <promedio ></promedio>
                </template>
                <template v-if="menu==13">
                    <promcurso ></promcurso>
                </template>
                <template v-if="menu==18">
                    <horarioam ></horarioam>
                </template>
                <template v-if="menu==21">
                    <reporteal></reporteal>
                </template>

                <template v-if="menu==11">
                    <h1>Ayuda</h1>
                </template>

                <template v-if="menu==12">
                    <h1>Acerca de</h1>
                </template>
                <template v-if="menu==14">
                    <welcome ></welcome>
                </template>
            @else
           
            @endif
    @endif
    @endsection