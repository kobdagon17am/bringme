@extends('layouts.backend.app')

@section('content')
<div class="content">
            <h2 class="intro-y text-lg font-medium mt-10">
                Gen BarCode
            </h2>


            @foreach($barcode as $value)
            <div class="intro-y box px-5 pt-5 mt-5">
                <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                    <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative" >
                            <b class="mt-5">COD:{{$value->barcode}} {{$value->name_th}}</b>
                            <div class="">{!! DNS1D::getBarcodeHTML("$value->barcode", 'C128B') !!}

                            <br>

                            </div>

                           {{-- {!!DNS1D::getBarcodeHTML('4445645656', 'C39+');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'C39E');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'C39E+');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'C93');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'S25');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'S25+');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'I25');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'I25+');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'C128');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'C128A');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'C128B');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'C128C');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'GS1-128');!!}
                           {!!DNS1D::getBarcodeHTML('44455656', 'EAN2');!!}
                           {!!DNS1D::getBarcodeHTML('4445656', 'EAN5');!!}
                           {!!DNS1D::getBarcodeHTML('4445', 'EAN8');!!}
                           {!!DNS1D::getBarcodeHTML('4445', 'EAN13');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'UPCA');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'UPCE');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'MSI');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'MSI+');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'POSTNET');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'PLANET');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'RMS4CC');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'KIX');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'IMB');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'CODABAR');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'CODE11');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'PHARMA');!!}
                           {!!DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T');!!} --}}

                    </div>
                    <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                        <div class="font-medium text-center lg:text-left lg:mt-3">{{$products->name_th}}</div>
                        <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                           <p>
                            <b> รายละเอียด: </b> {{$products->name_th}}<br>
                             <b> Code: </b> {{$products->products_code}}<br>
                             <b> จำนวน: </b> {{$value->qty}}<br>
                        </p>
                            {{-- <div class="truncate sm:whitespace-normal flex items-center mt-3"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="instagram" data-lucide="instagram" class="lucide lucide-instagram w-4 h-4 mr-2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg> Instagram The Empty Kite </div>
                            <div class="truncate sm:whitespace-normal flex items-center mt-3"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="twitter" data-lucide="twitter" class="lucide lucide-twitter w-4 h-4 mr-2"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5 0-.28-.03-.56-.08-.83A7.72 7.72 0 0023 3z"></path></svg> Twitter The Empty Kite</div> --}}
                            <button class="btn btn-primary  mb-2 mt-2" data-tw-toggle="modal" data-tw-target="#print-modal_{{$value->id}}"><i data-lucide="printer" class="w-4 h-4 mx-auto" ></i>  Print </button>
                            <a href="{{route('admin/pdf_barcode',['product_id'=>11,'count'=>12])}}">test</a>

                        </div>
                    </div>

                </div>

            </div>

            <div id="print-modal_{{$value->id}}" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="p-5 text-center">

                                <div class="text-3xl mt-5">เลือกจำนวนที่ต้องการพิมพ์</div>

                                <div class="grid grid-cols-12 gap-2 px-5 text-center mt-5 mx-auto">
                                    <input type="number" class="form-control col-span-12" value="1">
                                </div>

                            </div>
                            <div class="px-5 pb-8 text-center">
                                {{-- <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button> --}}
                                <button type="button" class="btn btn-primary w-24"><i data-lucide="printer" class="w-4 h-4 mx-auto" ></i>  Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
@endsection

@section('js')

@endsection
