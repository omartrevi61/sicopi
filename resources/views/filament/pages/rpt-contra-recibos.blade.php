<x-filament-panels::page>

    <x-filament::card>

        <div class="row">
            <div class="col-sm-12 col-md-3">
                <div class="row">
                    <div class="col-sm-12">
                        <h6>Elige el reporte</h6>
                        <div class="form-group">
                            <select wire:model.live="tipoReporte"
                                class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                <option value="0">Relación de Contrarecibos</option> 
                                <option value="1">Contrarecibos a nivel documento</option>
                                {{-- <option value="2">Por Centro</option>          --}}
                            </select>
                        </div>
                    </div>

                    @if ($tipoReporte == 0 || $tipoReporte == 1)
                        <div class="col-sm-12">
                            <h6>Elige el Proyecto</h6>
                            <div class="form-group">
                                <select wire:model.live="cual"                             
                                class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                    <option value="0">Todos</option>
                                    @foreach($proyectos as $proyecto)
                                        <option value="{{$proyecto->id}}">{{$proyecto->proyecto}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    
{{--                     @if ($tipoReporte == 1)
                        <div class="col-sm-12">
                            <h6>Elige el Responsable</h6>
                            <div class="form-group">
                                <select wire:model="cual" class="form-control">
                                    <option value="0">Todos</option>
                                    @foreach($responsables as $responsable)
                                        <option value="{{$responsable->id}}">{{$responsable->nombre_completo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
 --}}
                   {{--  @if ($tipoReporte == 2)
                        <div class="col-sm-12">
                            <h6>Elige el Centro</h6>
                            <div class="form-group">
                                <select wire:model="cual" class="form-control">
                                    <option value="0">Todos</option>
                                    @foreach($centros as $centro)
                                        <option value="{{$centro->id}}">{{$centro->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif --}}
                    
                </div>
            </div>
        </div>

    </x-filament::card>

    <div class="col-sm-12">
        
        <a style="background-color: #366cf4; color: white;" class="font-bold py-3 px-4 rounded" 
        href="{{ url('rptRecibos' . '/' . $tipoReporte . '/' . $cual)}}" target="_blank">Generar PDF</a>

        <span>&nbsp;</span>

        <a style="background-color: #366cf4; color: white;"  class="font-bold py-3 px-4 rounded" 
        href="{{ url('recibosExcel' . '/' . $tipoReporte . '/' . $cual)}}" target="_blank">Exportar a Excel</a>
    </div>
</x-filament-panels::page>
