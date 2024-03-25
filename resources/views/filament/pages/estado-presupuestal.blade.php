<x-filament-panels::page>
    <x-filament::card>

        <div class="row">
            <div class="col-sm-12 col-md-3">
                <div class="row">
                    <div class="col-sm-12">
                        <h6>Como deseas el Reporte</h6>
                        <div class="form-group">
                            <select wire:model.live="tipoReporte" 
                            class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                <option value="0">Por Tipo de Proyecto</option> 
                                <option value="1">Por Responsable</option>
                                <option value="2">Por Centro</option>         
                            </select>
                        </div>
                    </div>

                    @if ($tipoReporte == 0)
                        <div class="col-sm-12">
                            <h6>Elige el Tipo de Proyecto</h6>
                            <div class="form-group">
                                <select wire:model.live="cual" 
                                class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="0">Todos</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    
                    @if ($tipoReporte == 1)
                        <div class="col-sm-12">
                            <h6>Elige el Responsable</h6>
                            <div class="form-group">
                                <select wire:model.live="cual"
                                    class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                    <option value="0">Todos</option>
                                    @foreach($profesores as $profesor)
                                        <option value="{{$profesor->id}}">{{$profesor->nombre_completo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    @if ($tipoReporte == 2)
                        <div class="col-sm-12">
                            <h6>Elige el Centro</h6>
                            <div class="form-group">
                                <select wire:model.live="cual"
                                    class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                    <option value="0">Todos</option>
                                    @foreach($centros as $centro)
                                        <option value="{{$centro->id}}">{{$centro->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>

    </x-filament::card>

    <div class="col-sm-12">

        {{-- <a class="bg-white text-gray-700 font-bold py-4 px-4 rounded"
        href="{{ url('rptEdoPtal' . '/' . $tipoReporte . '/' . $cual)}}" target="_blank">Generar PDF</a> --}}
        
        <a style="background-color: #366cf4; color: white;" class="font-bold py-3 px-4 rounded" 
        href="{{ url('rptEdoPtal' . '/' . $tipoReporte . '/' . $cual)}}" target="_blank">Generar PDF</a>

        <span>&nbsp;</span>

        <a style="background-color: #366cf4; color: white;"  class="font-bold py-3 px-4 rounded" 
        href="{{ url('EdoPtalExcel' . '/' . $tipoReporte . '/' . $cual)}}" target="_blank">Exportar a Excel</a>
    </div>
    
</x-filament-panels::page>
