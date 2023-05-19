@extends('layout.main')
@section('content')
  <style>
      .collapse {
          visibility: initial !important;
      }
  </style>
  <div class="page-heading">
    <h1 class="page-title">Configuration</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('configuration', [ 'shop' => auth()->user()->name]) }}"><i class="fa fa-gears"></i></a>
      </li>
      <li class="breadcrumb-item">Configuration</li>
    </ol>
  </div>

  <div class="loader toggle-loader">
    <div class="spinner"></div>
  </div>
  {{-- // Start Enable Module Section --}}
  @include("layout.partials.enable")
  {{-- // End Enable Module Section --}}

  <div class="page-content fade-in-up">
    <div class="row">
      <div class="col-sm-12 col-md-5">
        <div class="ibox">
          {{-- Save Configuration --}}
          <form action="{{ url('save_configuration') }}" method="GET">
            @csrf
            {{-- Faq Section Settings --}}
            <div class="ibox-head ibox-head-accordian ibox-top-hr">
              <div class="ibox-title">Faq Section Settings</div>
            </div>
            <div class="ibox-body ibox-body-accordian">
              <div class="row">
                <fieldset class="row form-group  border p-1 pb-4 w-full m-2">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Section Background</small></legend><hr class="border-0">
                  {{-- BACKGROUND --}}
                  <div class="col-12 col-md-6 mt-2" >
                    <label class="mr-2">Background Color</label>
                    <input type="color" style=" margin-left: auto;"
                           onchange="colorChange()" class="form_control_color_picker" id="rjee_faqs_background_color" name="rjee_faqs_background_color" value="{{ ($configuration->rjee_faqs_background_color) ?? '#000000' }}"
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  {{-- END BACKGROUND --}}
                </fieldset>
              </div>
              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2 section-magin">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Section Margin</small></legend><hr class="border-0">
                  {{-- MARGIN --}}
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Margin Top</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_margin_top) ?? '10' }}" @endif; id="rjee_faqs_section_margin_top" name="rjee_faqs_section_margin_top"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Margin Bottom</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_margin_bottom) ?? '10' }}" @endif; id="rjee_faqs_section_margin_bottom" name="rjee_faqs_section_margin_bottom"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Margin Left</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_margin_left) ?? '10' }}" @endif; id="rjee_faqs_section_margin_left" name="rjee_faqs_section_margin_left"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Margin Right</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_margin_right) ?? '10' }}" @endif; id="rjee_faqs_section_margin_right" name="rjee_faqs_section_margin_right"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  {{-- END MARGIN --}}
                </fieldset>
              </div>
              {{-- Margin -md --}}

              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2 section-magin">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Section Margin-MD(Tablet)</small></legend><hr class="border-0">
                  {{-- MARGIN --}}
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Margin Top</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_margin_top_md) ?? '10' }}" @endif; id="rjee_faqs_section_margin_top_md" name="rjee_faqs_section_margin_top_md"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Margin Bottom</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_margin_bottom_md) ?? '10' }}" @endif; id="rjee_faqs_section_margin_bottom_md" name="rjee_faqs_section_margin_bottom_md"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Margin Left</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_margin_left_md) ?? '10' }}" @endif; id="rjee_faqs_section_margin_left_md" name="rjee_faqs_section_margin_left_md"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Margin Right</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_margin_right_md) ?? '10' }}" @endif; id="rjee_faqs_section_margin_right_md" name="rjee_faqs_section_margin_right_md"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  {{-- END MARGIN --}}
                </fieldset>
              </div>

              {{-- END Margin -md --}}

              {{-- Margin -xs --}}
              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2 section-magin">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Section Margin-XS(Mobile)</small></legend><hr class="border-0">
                  {{-- MARGIN --}}
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Margin Top</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_margin_top_xs) ?? '10' }}" @endif; id="rjee_faqs_section_margin_top_xs" name="rjee_faqs_section_margin_top_xs"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Margin Bottom</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_margin_bottom_xs) ?? '10' }}" @endif; id="rjee_faqs_section_margin_bottom_xs" name="rjee_faqs_section_margin_bottom_xs"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Margin Left</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_margin_left_xs) ?? '10' }}" @endif; id="rjee_faqs_section_margin_left_xs" name="rjee_faqs_section_margin_left_xs"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Margin Right</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_margin_right_xs) ?? '10' }}" @endif; id="rjee_faqs_section_margin_right_xs" name="rjee_faqs_section_margin_right_xs"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  {{-- END MARGIN --}}
                </fieldset>
              </div>

              {{-- END Margin -xs --}}


              {{-- PADDINGS --}}

              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Section Padding</small></legend><hr class="border-0">

                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Top</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_padding_top) ?? '20' }}" @endif; id="rjee_faqs_section_padding_top" name="rjee_faqs_section_padding_top"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Bottom</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_padding_bottom) ?? '10' }}" @endif; id="rjee_faqs_section_padding_bottom" name="rjee_faqs_section_padding_bottom"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Padding  Left</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_padding_left) ?? '12' }}" @endif; id="rjee_faqs_section_padding_left" name="rjee_faqs_section_padding_left"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Right</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_padding_right) ?? '15' }}" @endif; id="rjee_faqs_section_padding_right" name="rjee_faqs_section_padding_right"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>

                  {{-- END PADDINGS --}}
                </fieldset>
              </div>
              {{--Padding-md --}}
              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Section Padding-MD(Tablet)</small></legend><hr class="border-0">

                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Top</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_padding_top_md) ?? '20' }}" @endif; id="rjee_faqs_section_padding_top_md" name="rjee_faqs_section_padding_top_md"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Bottom</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_padding_bottom_md) ?? '10' }}" @endif; id="rjee_faqs_section_padding_bottom_md" name="rjee_faqs_section_padding_bottom_md"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Padding  Left</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_padding_left_md) ?? '12' }}" @endif; id="rjee_faqs_section_padding_left_md" name="rjee_faqs_section_padding_left_md"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Right</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_padding_right_md) ?? '15' }}" @endif; id="rjee_faqs_section_padding_right_md" name="rjee_faqs_section_padding_right_md"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>

                  {{-- END PADDINGS --}}
                </fieldset>
              </div>

              {{--End Padding-md --}}

              {{-- Padding-xs --}}
              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Section Padding-XS(Mobile)</small></legend><hr class="border-0">

                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Top</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_padding_top_xs) ?? '20' }}" @endif; id="rjee_faqs_section_padding_top_xs" name="rjee_faqs_section_padding_top_xs"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Bottom</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_padding_bottom_xs) ?? '10' }}" @endif; id="rjee_faqs_section_padding_bottom_xs" name="rjee_faqs_section_padding_bottom_xs"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Padding  Left</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_padding_left_xs) ?? '12' }}" @endif; id="rjee_faqs_section_padding_left_xs" name="rjee_faqs_section_padding_left_xs"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Right</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_section_padding_right_xs) ?? '15' }}" @endif; id="rjee_faqs_section_padding_right_xs" name="rjee_faqs_section_padding_right_xs"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>

                  {{-- END PADDINGS --}}
                </fieldset>
              </div>

              {{--End Padding-xs --}}

            </div>
            {{-- END Faq Section Settings --}}

            {{-- FAQ HEADER TYPOGRAPHY --}}
            <div class="ibox-head ibox-head-accordian ibox-top-hr">
              <div class="ibox-title">Faq Header Typography</div>
            </div>
            <div class="ibox-body ibox-body-accordian">
              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Title Typography</small></legend><hr class="border-0">
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Text</label>
                    <input class="form-control form-control-sm bg-light" id="rjee_faqs_title" type="text" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_title) ?? 'Signup with' }}" @endif; placeholder="Faq Header Text" name="rjee_faqs_title" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif >
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Font Size</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_header_text_font_size) ?? '16' }}" @endif; id="rjee_faqs_header_text_font_size" name="rjee_faqs_header_text_font_size"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Font Family</label>
                    <select class="form-control form-control-sm" id='rjee_faqs_header_text_font' class="form-label form-select border-0 bg-light" name='rjee_faqs_header_text_font' onchange="" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                      @include("layout.partials.allfont_options")
                    </select>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Text Alignment</label>
                    <select class="form-control form-control-sm" id='rjee_faqs_header_align_text' class="form-label form-select border-0 bg-light" name='rjee_faqs_header_align_text' onchange="" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                      <option value="0">Text Alignment</option>
                      <option value="left">Left</option>
                      <option value="center">Center</option>
                      <option value="right">Right</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6 mt-2" >
                    <label class="mr-2">Font Color</label>
                    <input type="color" style=" margin-left: auto;"
                           onchange="colorChange()" class="form_control_color_picker" id="rjee_faqs_header_text_color" name="rjee_faqs_header_text_color" value="{{ ($configuration->rjee_faqs_header_text_color) ?? '#000000' }}"
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                </fieldset>
              </div>
              {{--sub-title typography--}}
              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Sub-Title Typography</small></legend><hr class="border-0">
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Text</label>
                    <input class="form-control form-control-sm bg-light" id="rjee_faqs_sub_title" type="text" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_sub_title) ?? 'Signup with' }}" @endif; placeholder="Faq Header Text" name="rjee_faqs_sub_title" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif >
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Font Size</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->rjee_faqs_header_sub_text_font_size) ?? '24' }}" @endif; id="rjee_faqs_header_sub_text_font_size" name="rjee_faqs_header_sub_text_font_size"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Font Family</label>
                    <select class="form-control form-control-sm" id='rjee_faqs_header_sub_text_font' class="form-label form-select border-0 bg-light" name='rjee_faqs_header_sub_text_font' onchange="" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                      @include("layout.partials.allfont_options")
                    </select>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Text Alignment</label>
                    <select class="form-control form-control-sm" id='rjee_faqs_header_align_sub_text' class="form-label form-select border-0 bg-light" name='rjee_faqs_header_align_sub_text' onchange="" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                      <option value="0">Text Alignment</option>
                      <option value="left">Left</option>
                      <option value="center">Center</option>
                      <option value="right">Right</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6 mt-2" >
                    <label class="mr-2">Font Color</label>
                    <input type="color" style=" margin-left: auto;"
                           onchange="colorChange()" class="form_control_color_picker" id="rjee_faqs_header_sub_text_color" name="rjee_faqs_header_sub_text_color" value="{{ ($configuration->rjee_faqs_header_sub_text_color) ?? '#000000' }}"
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                </fieldset>
              </div>
              {{--End sub-title typography--}}
            </div>
            <div class="ibox-head ibox-head-accordian ibox-top-hr">
              <div class="ibox-title">Accordian Typography</div>
            </div>

            <div class="ibox-body ibox-body-accordian">
              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Accordion item Gap</small></legend><hr class="border-0">


                  <div class="col-12 ">
                    <label class="mr-2">Accordion item Gap</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_faq_gap) ?? '12' }}" @endif; id="accordion_item_faq_gap" name="accordion_item_faq_gap"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>

                </fieldset>
              </div>

              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Tab Typography</small></legend><hr class="border-0">
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Font Size</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_text_font_size) ?? '16' }}" @endif; id="accordion_item_question_text_font_size" name="accordion_item_question_text_font_size"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Text Alignment</label>
                    <select class="form-control form-control-sm" id='accordion_item_question_align_text' class="form-label form-select border-0 bg-light" name='accordion_item_question_align_text' onchange="" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                      <option value="1">Left</option>
                      <option value="2">Centered</option>
                      <option value="3">Right</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Font Family</label>
                    <select class="form-control form-control-sm" id='accordion_item_question_text_font' class="form-label form-select border-0 bg-light" name='accordion_item_question_text_font' onchange="" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                      @include("layout.partials.allfont_options")
                    </select>
                  </div>
                  <div class="col-12 col-md-6 mt-2" >
                    <label class="mr-2">Text Color</label>
                    <input type="color" style=" margin-left: auto;"
                           onchange="colorChange()" class="form_control_color_picker" id="accordion_item_question_text_color" name="accordion_item_question_text_color" value="{{ ($configuration->accordion_item_question_text_color) ?? '#000000' }}"
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2" >
                    <label class="mr-2">Active Text Color</label>
                    <input type="color" style=" margin-left: auto;"
                           onchange="colorChange()" class="form_control_color_picker" id="accordion_item_question_text_active_color" name="accordion_item_question_text_active_color" value="{{ ($configuration->accordion_item_question_text_active_color) ?? '#000000' }}"
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                </fieldset>
              </div>


              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Tab Content Typography</small></legend><hr class="border-0">
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Font Size</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_answer_text_font_size) ?? '16' }}" @endif; id="accordion_item_answer_text_font_size" name="accordion_item_answer_text_font_size"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Text Alignment</label>
                    <select class="form-control form-control-sm" id='accordion_item_answer_align_text' class="form-label form-select border-0 bg-light" name='accordion_item_answer_align_text' onchange="" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                      <option value="1">Left</option>
                      <option value="2">Centered</option>
                      <option value="3">Right</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Font Family</label>
                    <select class="form-control form-control-sm" id='accordion_item_answer_text_font' class="form-label form-select border-0 bg-light" name='accordion_item_answer_text_font' onchange="" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                      @include("layout.partials.allfont_options")
                    </select>
                  </div>
                  <div class="col-12 col-md-6 mt-2" >
                    <label class="mr-2">Text Color</label>
                    <input type="color" style=" margin-left: auto;"
                           onchange="colorChange()" class="form_control_color_picker" id="accordion_item_answer_text_color" name="accordion_item_answer_text_color" value="{{ ($configuration->accordion_item_answer_text_color) ?? '#000000' }}"
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>

                </fieldset>
              </div>
              {{-- Border color Settings--}}
              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Border Color Settings</small></legend><hr class="border-0">
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Border Color</label>
                    <input type="color" style=" margin-left: auto;"
                           onchange="colorChange()" class="form_control_color_picker" id="accordion_item_question_border_color" name="accordion_item_question_border_color" value="{{ ($configuration->accordion_item_question_border_color) ?? '#000000' }}"
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2" >
                    <label class="mr-2">Active Border Color</label>
                    <input type="color" style=" margin-left: auto;"
                           onchange="colorChange()" class="form_control_color_picker" id="accordion_item_question_border_active_color" name="accordion_item_question_border_active_color" value="{{ ($configuration->accordion_item_question_border_active_color) ?? '#000000' }}"
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2" >
                    <label class="mr-2">Focus  Color</label>
                    <input type="color" style=" margin-left: auto;"
                           onchange="colorChange()" class="form_control_color_picker" id="accordion_item_question_focus_color" name="accordion_item_question_focus_color" value="{{ ($configuration->accordion_item_question_focus_color) ?? '#000000' }}"
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                </fieldset>
              </div>
              {{-- END Border color Settings--}}

              {{-- Border Width --}}
              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Border Width</small></legend><hr class="border-0">
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Top Border</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_border_top) ?? '0' }}" @endif; id="accordion_item_question_border_top" name="accordion_item_question_border_top"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Bottom Border</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_border_bottom) ?? '0' }}" @endif; id="accordion_item_question_border_bottom" name="accordion_item_question_border_bottom"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Left Border</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_border_left) ?? '0' }}" @endif; id="accordion_item_question_border_left" name="accordion_item_question_border_left"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Right Border</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_border_right) ?? '0' }}" @endif; id="accordion_item_question_border_right" name="accordion_item_question_border_right"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                </fieldset>
              </div>
              {{-- END Border Radius--}}

              {{-- Border Radius --}}
              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Border Radius</small></legend><hr class="border-0">

                  {{--<div class="col-12 col-md-6 mt-2">--}}
                  {{--  <label class="mr-2">Border Size</label>--}}
                  {{--  <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_border_size) ?? '16' }}" @endif; id="accordion_item_question_border_size" name="accordion_item_question_border_size"--}}
                  {{--         onchange=""--}}
                  {{--         @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>--}}
                  {{--</div>--}}

                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Top-Left Radius</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_border_radius_topleft) ?? '10' }}" @endif; id="accordion_item_question_border_radius_topleft" name="accordion_item_question_border_radius_topleft"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Top-Right Radius</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_border_radius_topright) ?? '10' }}" @endif; id="accordion_item_question_border_radius_topright" name="accordion_item_question_border_radius_topright"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Bottom Left</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_border_radius_bottomleft) ?? '10' }}" @endif; id="accordion_item_question_border_radius_bottomleft" name="accordion_item_question_border_radius_bottomleft"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">bottom Right</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_border_radius_bottomright) ?? '10' }}" @endif; id="accordion_item_question_border_radius_bottomright" name="accordion_item_question_border_radius_bottomright"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>

                </fieldset>
              </div>
              {{-- END Border Radius--}}

              {{--  Border Radius After---}}
              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Border Radius After</small></legend><hr class="border-0">

                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Top-Left Radius</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_border_radius_after_topleft) ?? '10' }}" @endif; id="accordion_item_question_border_radius_after_topleft" name="accordion_item_question_border_radius_after_topleft"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Top-Right Radius</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_border_radius_after_topright) ?? '10' }}" @endif; id="accordion_item_question_border_radius_after_topright" name="accordion_item_question_border_radius_after_topright"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Bottom-Right Radius</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_border_radius_after_bottomleft) ?? '10' }}" @endif; id="accordion_item_question_border_radius_after_bottomleft" name="accordion_item_question_border_radius_after_bottomleft"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Bottom Right</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_border_radius_after_bottomright) ?? '10' }}" @endif; id="accordion_item_question_border_radius_after_bottomright" name="accordion_item_question_border_radius_after_bottomright"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>

                </fieldset>
              </div>

              {{-- End Border Radius After---}}


              {{-- Accordion Signs ---}}
              <div class="row">
                <fieldset class="row form-group border p-1 pb-4 w-full m-2">
                  <legend class="w-auto mx-1 px-2 text-green animate-pulse"><small>Accordion Signs</small></legend><hr class="border-0">

                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Collapse Icons Alignment</label>
                    <select class="form-control form-control-sm" id='accordion_item_question_collapse_icon_align' class="form-label form-select border-0 bg-light" name='accordion_item_question_collapse_icon_align' onchange="" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                      <option value="0">Left</option>
                      <option value="1">Right</option>

                    </select>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Select Collapse Icons </label>
                    <select class="form-control form-control-sm" id='accordion_item_question_collapse_icon' class="form-label form-select border-0 bg-light" name='accordion_item_question_collapse_icon' onchange="" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                      <option value="0">Angles-Up</option>
                      <option value="1">Plus</option>
                      <option value="2">Check</option>
                      <option value="3">Circle-check</option>
                      <option value="3">Square-check</option>
                      <option value="3">Angle-Down</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Select Non-Collapse Icons </label>
                    <select class="form-control form-control-sm" id='accordion_item_question_non_collapse_icon' class="form-label form-select border-0 bg-light" name='accordion_item_question_non_collapse_icon' onchange="" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                      <option value="0">Angle-up</option>
                      <option value="1">Minus</option>
                      <option value="2">X-Mark</option>
                      <option value="3">X-Mark-Circle</option>
                      <option value="3">X-Mark-Square</option>
                      <option value="3">Angles-Up</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Collapse Icon Font-Size</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_collapse_icon_font_size) ?? '10' }}" @endif; id="accordion_item_question_collapse_icon_font_size" name="accordion_item_question_collapse_icon_font_size"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Collapse Icon Line-height</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_collapse_icon_line_height) ?? '10' }}" @endif; id="accordion_item_question_collapse_icon_line_height" name="accordion_item_question_collapse_icon_line_height"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Collapse Icon Padding-left</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_collapse_icon_padding_left) ?? '10' }}" @endif; id="accordion_item_question_collapse_icon_padding_left" name="accordion_item_question_collapse_icon_padding_left"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Collapse Icon Padding-right</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_collapse_icon_padding_right) ?? '10' }}" @endif; id="accordion_item_question_collapse_icon_padding_right" name="accordion_item_question_collapse_icon_padding_right"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Collapse Icon Padding-top</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_collapse_icon_padding_top) ?? '10' }}" @endif; id="accordion_item_question_collapse_icon_padding_top" name="accordion_item_question_collapse_icon_padding_top"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>
                  <div class="col-12 col-md-6 mt-2">
                    <label class="mr-2">Collapse Icon Padding-bottom</label>
                    <input type="number" class="form-control form-control-sm bg-light" min="0" max="100" step="1" @if($configuration !=null) value="{{ ($configuration->accordion_item_question_collapse_icon_padding_bottom) ?? '10' }}" @endif; id="accordion_item_question_collapse_icon_padding_bottom" name="accordion_item_question_collapse_icon_padding_bottom"
                           onchange=""
                           @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>
                  </div>

                </fieldset>
              </div>
            </div>
            {{-- End Accordion Signs ---}}

            <div class="ibox-footer">
              <button class="btn btn-outline-primary mr-2 w-full" type="submit" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif; @endif>Save</button>
            </div>
          </form>
          {{-- END Save Configuration --}}
        </div>
      </div>

      {{-- //  PREVIEW  SECTION CODE  --}}
      <style>
          .accordion {
              --bs-accordion-color: {{ $configuration->accordion_item_answer_text_color ?? "#212529" }};
              --bs-accordion-bg: #dfdfd8;
              --bs-accordion-transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,border-radius .15s ease;
              /*--bs-accordion-border-color: #e24329;*/
              --bs-accordion-border-width: 1px;
              --bs-accordion-border-radius: .375rem;
              --bs-accordion-inner-border-radius: calc(.375rem - 1px);
              --bs-accordion-btn-padding-x: 1.25rem;
              --bs-accordion-btn-padding-y: 1rem;
              --bs-accordion-btn-color: {{ $configuration->accordion_item_question_text_color ?? "#212529" }};
              --bs-accordion-btn-bg: var(--bs-accordion-bg);
              --bs-accordion-btn-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
              --bs-accordion-btn-icon-width: 1.25rem;
              --bs-accordion-btn-icon-transform: rotate(-180deg);
              --bs-accordion-btn-icon-transition: transform .2s ease-in-out;
              --bs-accordion-btn-active-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230c63e4'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
              /*--bs-accordion-btn-focus-border-color: #86b7fe;*/
              --bs-accordion-btn-focus-box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
              --bs-accordion-body-padding-x: 1.25rem;
              --bs-accordion-body-padding-y: 1rem;
              --bs-accordion-active-color: {{ $configuration->accordion_item_question_text_active_color ?? "#212529" }};
              --bs-accordion-active-bg: #e7f1ff;
          }

      </style>
      <div class="col-sm-12 col-md-7 pr-8" >
        {{-- <div class="col-sm-12 col-md-4 pr-8 lg:fixed lg:bottom-6 lg:right-6"> --}}
        <div class="ibox">
          <div class="ibox-head ibox-top-hr">
            <div class="ibox-title">Preview</div>
          </div>
          <div class="ibox-body bg-[#f8f9fa]">
            <div class="row py-1" @if($configuration !=null) @if($configuration->is_enabled == 0) disabled readonly style="opacity:0.5;pointer-events: none;user-select: none;"  @endif @endif>
              <div class="col-12">
                <fieldset class="sticky-md-top form-group border p-1 px-1 pb-1">
                  <legend class="w-auto mx-1 px-2 text-[#00a0ac] animate-pulse"><small>Preview:</small></legend>
                  <div class="container inline-flex flex-col" id="full-background"
                       style="
                                    background:<?php echo $configuration->rjee_faqs_background_color; ?>;

                                    ">
                    {{-- //  PREVIEW  SECTION HTML  --}}
                    <div class="rte container" id="rjee_faq-ibox"
                         style="
                                              height:vh;
                                              width:vw;


                                              margin-top:<?php echo $configuration->rjee_faqs_section_margin_top; ?>px;
                                              margin-bottom:<?php echo $configuration->rjee_faqs_section_margin_bottom; ?>px;
                                              margin-left:<?php echo $configuration->rjee_faqs_section_margin_left; ?>px;
                                              margin-right:<?php echo $configuration->rjee_faqs_section_margin_right; ?>px;



                                              padding-top:<?php echo $configuration->rjee_faqs_section_padding_top; ?>px;
                                              padding-bottom:<?php echo $configuration->rjee_faqs_section_padding_bottom; ?>px;
                                              padding-left:<?php echo $configuration->rjee_faqs_section_padding_left; ?>px;;
                                              padding-right:<?php echo $configuration->rjee_faqs_section_padding_right; ?>px;

                                              margin-top: <?php echo $configuration->rjee_faqs_section_margin_top_xs; ?>px;
                                              ">
                      <div class="container">
                        <div class="row">
                          <div class="col-12">
                            <!-- section title start -->
                            <div class="section-title text-center">
                              <h2 class="title" id="Title-Typography" style="
                                                            color: {{ $configuration->rjee_faqs_header_text_color }};
                                                            text-align: {{ $configuration->rjee_faqs_header_align_text }};
                                                            font-size:<?php echo $configuration->rjee_faqs_header_text_font_size; ?>px;
                                                            ">ORDER/PAYMENT/CANCELLATION] HOW DO I CANCEL OR CHANGE AN ORDER?
                              </h2>
                              <p class="sub-title" id="sub-Title-Typography" style="
                                                            color: {{ $configuration->rjee_faqs_header_sub_text_color }};
                                                            text-align: {{ $configuration->rjee_faqs_header_align_sub_text }};
                                                            font-size: {{ $configuration->rjee_faqs_header_sub_text_color }}px;"
                              >Section Sub Title Here</p>
                            </div>
                            <!-- section title start -->
                          </div>
                        </div>
                      </div>
                      <div class="container">
                        <div class="accordion" id="accordion_Rjee_FAQ">
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-1">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1">
                                FAQ Question Heading text to display.
                              </button>
                            </h2>
                            <div id="collapse-1" class="accordion-collapse collapse " aria-labelledby="heading-1" data-bs-parent="#accordion_Rjee_FAQ">
                              <div class="accordion-body">
                                <p>FAQ Answer text to display</p>
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-2">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                FAQ Question Heading text to display.
                              </button>
                            </h2>
                            <div id="collapse-2" class="accordion-collapse collapse " aria-labelledby="heading-2" data-bs-parent="#accordion_Rjee_FAQ">
                              <div class="accordion-body">
                                <p>FAQ Answer text to display</p>
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-3">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                FAQ Question Heading text to display.
                              </button>
                            </h2>
                            <div id="collapse-3" class="accordion-collapse collapse " aria-labelledby="heading-3" data-bs-parent="#accordion_Rjee_FAQ">
                              <div class="accordion-body">
                                <p>FAQ Answer text to display</p>
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-4">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                FAQ Question Heading text to display.
                              </button>
                            </h2>
                            <div id="collapse-4" class="accordion-collapse collapse " aria-labelledby="heading-4" data-bs-parent="#accordion_Rjee_FAQ">
                              <div class="accordion-body">
                                <p>FAQ Answer text to display</p>
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-5">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                FAQ Question Heading text to display.
                              </button>
                            </h2>
                            <div id="collapse-5" class="accordion-collapse collapse" aria-labelledby="heading-5" data-bs-parent="#accordion_Rjee_FAQ" style="">
                              <div class="accordion-body">
                                <p>FAQ Answer text to display</p>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>

                    {{-- //  END PREVIEW  SECTION HTML  --}}


                  </div>
                </fieldset>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- //  END PREVIEW  SECTION CODE  --}}
    </div>
  </div>

@endsection

{{-----------------------------  preview  SECTION  input Fields Settings Code-----------------------------}}
@if($configuration)
  @if($configuration->is_enabled == 0)
    <script>
			$(document).ready( function(e){
				$('.other-configuration-block').find('*').attr('disabled', true);
				$('.other-configuration-block').find('*').css('opacity', "0.8");
			});
    </script>
  @endif
@endif

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
@section('scripts')
  <script>

		$('select[name="rjee_faqs_header_text_font"] option[value="{{ $configuration->rjee_faqs_header_text_font }}"]').prop("selected",true);
		$('select[name="rjee_faqs_header_sub_text_font"] option[value="{{ $configuration->rjee_faqs_header_sub_text_font }}"]').prop("selected",true);
		$('select[name="accordion_item_question_text_font"] option[value="{{ $configuration->accordion_item_question_text_font }}"]').prop("selected",true);
		$('select[name="accordion_item_answer_text_font"] option[value="{{ $configuration->accordion_item_answer_text_font }}"]').prop("selected",true);

		/* End Worked on Font family for preview */
		var shop_url = "<?php echo $shop; ?>";
		let is_enabled = 0;
		$('#is_enabled').on('click', function (e) {
			$(".loader").toggleClass('toggle-loader');
			if ($(this).prop("checked") == true) {
				is_enabled = 1;
			} else {
				is_enabled = 0;
			}
			$.ajax({
				url: "/enable_module",
				type: "GET",
				data: {
					"shop": shop_url,
					"token": window.sessionToken,
					"is_enabled": is_enabled,
					"_token": "{{ csrf_token() }}"
				},
				success: function (response) {
					$(".loader").toggleClass('toggle-loader');
					window.location.reload();
				},
				error: function (error) {
					$(".loader").toggleClass('toggle-loader');
				}
			});
		});

		function restoreValuesFromDB(){
			$("#full-background").css('background', $("#rjee_faqs_background_color").val());
			$("#rjee_faq-ibox").css('margin-top', $("#rjee_faqs_section_margin_top").val());
			$("#rjee_faq-ibox").css('margin-bottom', $("#rjee_faqs_section_margin_bottom").val());
			$("#rjee_faq-ibox").css('margin-left', $("#rjee_faqs_section_margin_left").val());
			$("#rjee_faq-ibox").css('margin-right', $("#rjee_faqs_section_margin_right").val());
		}
		restoreValuesFromDB();

		$("#rjee_faqs_background_color").on('input',function (){
			$("#full-background").css('background', $("#rjee_faqs_background_color").val());
		});
		$("#rjee_faqs_section_margin_top").on('input',function (){
			$("#rjee_faq-ibox").css('margin-top', $("#rjee_faqs_section_margin_top").val());
		});
		$("#rjee_faqs_section_margin_bottom").on('input',function (){
			$("#rjee_faq-ibox").css('margin-bottom', $("#rjee_faqs_section_margin_bottom").val());
		});
		$("#rjee_faqs_section_margin_left").on('input',function (){
			$("#rjee_faq-ibox").css('margin-left', $("#rjee_faqs_section_margin_left").val());
		});
		$("#rjee_faqs_section_margin_right").on('input',function (){
			$("#rjee_faq-ibox").css('margin-right', $("#rjee_faqs_section_margin_right").val());
		});
		//  XS

		$("#rjee_faqs_section_margin_top_xs").on('input',function (){
			$("#rjee_faq-ibox").css('margin-top', $("#rjee_faqs_section_margin_top_xs").val());
		});

		$("#rjee_faqs_section_padding_top").on('input',function (){
			$("#rjee_faq-ibox").css('padding-top', $("#rjee_faqs_section_padding_top").val());
		});
		$("#rjee_faqs_section_padding_bottom").on('input',function (){
			$("#rjee_faq-ibox").css('padding-bottom', $("#rjee_faqs_section_padding_bottom").val());
		});
		$("#rjee_faqs_section_padding_left").on('input',function (){
			$("#rjee_faq-ibox").css('padding-left', $("#rjee_faqs_section_padding_left").val());
		});
		$("#rjee_faqs_section_padding_right").on('input',function (){
			$("#rjee_faq-ibox").css('padding-right', $("#rjee_faqs_section_padding_right").val());
		});

    {{-- title --}}
		$("#rjee_faqs_title").on('input',function () {
			$("#Title-Typography").text($(this).val());
		});
		$("#rjee_faqs_header_text_color").on('input',function () {
			$("#Title-Typography").css('color', $("#rjee_faqs_header_text_color").val());
		});
		$("#rjee_faqs_header_align_text").on('input',function () {
			$("#Title-Typography").css('text-align', $("#rjee_faqs_header_align_text").val());
		});
		$("#rjee_faqs_header_text_font_size").on('input',function () {
			$("#Title-Typography").css('font-family', $("#rjee_faqs_header_text_font_size").val());
		});
		$("#rjee_faqs_header_text_font_size").on('input',function () {
			$("#Title-Typography").css('font-size', $("#rjee_faqs_header_text_font_size").val());
		});

    {{-- End title --}}


    {{-- Subtitle --}}
		$("#rjee_faqs_header_sub_text_color").on('input',function () {
			$("#sub-Title-Typography").css('color', $("#rjee_faqs_header_sub_text_color").val());
		});
		$("#rjee_faqs_sub_title").on('input',function () {
			$("#sub-Title-Typography").text($(this).val());
		});
		$("#rjee_faqs_header_align_sub_text").on('input',function () {
			$("#sub-Title-Typography").css('text-align', $("#rjee_faqs_header_align_sub_text").val());
		});
		$("#rjee_faqs_header_sub_text_font_size").on('input',function () {
			$("#sub-Title-Typography").css('font-size', $("#rjee_faqs_header_sub_text_font_size").val());
		});

    {{-- End Subtitle --}}

		//Accordian Typography | Tab Typography | question
		$("#accordion_item_question_text_color").on('input', function () {
			$(".accordion").css('--bs-accordion-btn-color', $(this).val());
		});

		$("#accordion_item_question_text_active_color").on('input', function () {
			$(".accordion").css('--bs-accordion-active-color', $(this).val());
		});
		$("#accordion_item_question_align_text").on('input',function () {
			$("#accordion_Rjee_FAQ").css('text-align', $("#accordion_item_question_align_text").val());
		});

		//Accordian Typography | Tab Content  Typography | Answer
		$("#accordion_item_answer_text_color").on('input', function () {
			$(".accordion-body").css('color', $(this).val());
		});

		//Accordian Typography | Border Color Settings
		$("#accordion_item_question_border_color").on('input', function () {
			$(".accordion").css('color', $(this).val());
		});
		$("#accordion_item_question_border_active_color").on('input', function () {
			$(".accordion").css('color', $(this).val());
		});

		$("#accordion_item_question_focus_color").on('input', function () {
			$(".accordion").css('color', $(this).val());
		});


		/* Start Worked on Font family for preview */
		function changeGFontOnSelectorChange (elementfontSelector, elementToChangeFamily) {
			$("#"+ elementfontSelector).on("change", function (){
				// console.log($(this).attr("name"));
				if ($(this) && $(this).attr("name") && $(this).val() ) {
					var googleFontLink = document.getElementById("googlefont__" + elementfontSelector);
					if (!googleFontLink) {
						googleFontLink = document.createElement("link");
						googleFontLink.id = "googlefont__" + elementfontSelector;
						googleFontLink.type = "text/css";
						googleFontLink.rel = "stylesheet";
						googleFontLink.media = "screen";
						document.head.appendChild(googleFontLink);
					}
					var anonymousPro = $(this).val()+"|"+$(this).val()+":300|"+$(this).val()+":regular|"+$(this).val()+":500|"+$(this).val()+":600|"+$(this).val()+":700|"+$(this).val()+":800|"+$(this).val()+":italic|"+$(this).val()+":500italic|"+$(this).val()+":600italic|"+$(this).val()+":700italic|"+$(this).val()+":800italic";
					var apiUrl = [];
					apiUrl.push('https://fonts.googleapis.com/css?family=');
					apiUrl.push(anonymousPro.replace(/ /g, '+'));
					// url: 'https://fonts.googleapis.com/css?family=Roboto|Roboto:300|Roboto:regular|Roboto:500|Roboto:600|Roboto:700|Roboto:800|Roboto:italic|Roboto:500italic|Roboto:600italic|Roboto:700italic|Roboto:800italic'
					var url = apiUrl.join('');
					// googleFontLink.href = "https://fonts.googleapis.com/css2?family=" + encodeURIComponent(selectedFont.family);
					// console.log(url);
					googleFontLink.href = url;

					$("#"+ elementToChangeFamily).css("font-family", $('select[name="'+ elementfontSelector +'"] option:selected').val());

				}
			});
		}
		changeGFontOnSelectorChange ("rjee_faqs_header_text_font", "Title-Typography");
		changeGFontOnSelectorChange ("rjee_faqs_header_sub_text_font", "sub-Title-Typography");
		changeGFontOnSelectorChange ("accordion_item_question_text_font", "accordion_Rjee_FAQ .accordion-button");
		changeGFontOnSelectorChange ("accordion_item_answer_text_font", "accordion_Rjee_FAQ .accordion-body");
		function changeGFontOnStart (elementfontSelector, elementToChangeFamily) {
			// console.log($(this).attr("name"));
			var fontSelector = $("#"+elementfontSelector).val();
			var googleFontLink = document.getElementById("googlefont__" + elementfontSelector);
			if (!googleFontLink) {
				googleFontLink = document.createElement("link");
				googleFontLink.id = "googlefont__" + elementfontSelector;
				googleFontLink.type = "text/css";
				googleFontLink.rel = "stylesheet";
				googleFontLink.media = "screen";
				document.head.appendChild(googleFontLink);
			}
			var anonymousPro = fontSelector+"|"+fontSelector+":300|"+fontSelector+":regular|"+fontSelector+":500|"+fontSelector+":600|"+fontSelector+":700|"+fontSelector+":800|"+fontSelector+":italic|"+fontSelector+":500italic|"+fontSelector+":600italic|"+fontSelector+":700italic|"+fontSelector+":800italic";
			var apiUrl = [];
			apiUrl.push('https://fonts.googleapis.com/css?family=');
			apiUrl.push(anonymousPro.replace(/ /g, '+'));
			// url: 'https://fonts.googleapis.com/css?family=Roboto|Roboto:300|Roboto:regular|Roboto:500|Roboto:600|Roboto:700|Roboto:800|Roboto:italic|Roboto:500italic|Roboto:600italic|Roboto:700italic|Roboto:800italic'
			var url = apiUrl.join('');
			// googleFontLink.href = "https://fonts.googleapis.com/css2?family=" + encodeURIComponent(selectedFont.family);
			// console.log(url);
			googleFontLink.href = url;
			$("#"+ elementToChangeFamily).css("font-family", $('select[name="'+ elementfontSelector +'"] option:selected').val());
		}
		changeGFontOnStart ("rjee_faqs_header_text_font", "Title-Typography");
		changeGFontOnStart ("rjee_faqs_header_sub_text_font", "sub-Title-Typography");
		changeGFontOnStart ("accordion_item_question_text_font", "accordion_Rjee_FAQ .accordion-button");
		changeGFontOnStart ("accordion_item_answer_text_font", "accordion_Rjee_FAQ .accordion-body");
		/* End Worked on Font family for preview */

    {{----------------------------- End preview  SECTION  input Fields Settings Code-----------------------------}}
		function colorChange(){}
  </script>

  <script>
		$(".accordion-item").css("margin-bottom", "{{ $configuration->accordion_item_faq_gap }}");
		$("#accordion_item_faq_gap").on('change', function(e){
			$(".accordion-item").css("margin-bottom", $(this).val());
		});

		$(".accordion-item").css({
			"border-start-start-radius": "{{ $configuration->accordion_item_question_border_radius_topleft + 3 }}px",
			"border-start-end-radius": "{{ $configuration->accordion_item_question_border_radius_topright + 3 }}px",
			"border-end-start-radius": "{{ $configuration->accordion_item_question_border_radius_bottomleft + 3 }}px",
			"border-end-end-radius": "{{ $configuration->accordion_item_question_border_radius_bottomright + 3 }}px"
		});

		$("#accordion_item_question_border_size," +
			"#accordion_item_question_border_radius_topleft," +
			"#accordion_item_question_border_radius_topright," +
			"#accordion_item_question_border_radius_bottomleft," +
			"#accordion_item_question_border_radius_bottomright").on('input',
			function(e){
				$(".accordion-item").css("border-start-start-radius", parseInt($("#accordion_item_question_border_radius_topleft").val()) +3);
				$(".accordion-item").css("border-start-end-radius", parseInt($("#accordion_item_question_border_radius_topright").val()) +3);
				$(".accordion-item").css("border-end-start-radius", parseInt($("#accordion_item_question_border_radius_bottomleft").val()) +3);
				$(".accordion-item").css("border-end-end-radius", parseInt($("#accordion_item_question_border_radius_bottomright").val()) +3);
			});

		$(".accordion-button.collapsed").css("border-color", "{{ $configuration->accordion_item_question_border_color }}");
		$(".accordion-button.collapsed").css("border-top", "{{ $configuration->accordion_item_question_border_top }}px solid {{ $configuration->accordion_item_question_border_color }}");
		$(".accordion-button.collapsed").css("border-bottom", "{{ $configuration->accordion_item_question_border_bottom }}px solid {{ $configuration->accordion_item_question_border_color }}");
		$(".accordion-button.collapsed").css("border-left", "{{ $configuration->accordion_item_question_border_left }}px solid {{ $configuration->accordion_item_question_border_color }}");
		$(".accordion-button.collapsed").css("border-right", "{{ $configuration->accordion_item_question_border_right }}px solid {{ $configuration->accordion_item_question_border_color }}");

		$(".accordion-button.collapsed").css("border-start-start-radius", "{{ $configuration->accordion_item_question_border_radius_topleft }}px");
		$(".accordion-button.collapsed").css("border-start-end-radius", "{{ $configuration->accordion_item_question_border_radius_topright }}px");
		$(".accordion-button.collapsed").css("border-end-start-radius", "{{ $configuration->accordion_item_question_border_radius_bottomleft }}px");
		$(".accordion-button.collapsed").css("border-end-end-radius", "{{ $configuration->accordion_item_question_border_radius_bottomright }}px");

		$(".accordion-item:first-of-type").css("border-start-start-radius", "{{ $configuration->accordion_item_question_border_radius_topleft + 3 }}px");
		$(".accordion-item:first-of-type").css("border-start-end-radius", "{{ $configuration->accordion_item_question_border_radius_topright + 3 }}px");
		$(".accordion-item:first-of-type").css("border-end-start-radius", "{{ $configuration->accordion_item_question_border_radius_bottomleft + 3 }}px");
		$(".accordion-item:first-of-type").css("border-end-end-radius", "{{ $configuration->accordion_item_question_border_radius_bottomright + 3 }}px");

		$(".accordion-item:first-of-type .accordion-button.collapsed").css("border-start-start-radius", "{{ $configuration->accordion_item_question_border_radius_topleft }}px");
		$(".accordion-item:first-of-type .accordion-button.collapsed").css("border-start-end-radius", "{{ $configuration->accordion_item_question_border_radius_topright }}px");
		$(".accordion-item:first-of-type .accordion-button.collapsed").css("border-end-start-radius", "{{ $configuration->accordion_item_question_border_radius_bottomleft }}px");
		$(".accordion-item:first-of-type .accordion-button.collapsed").css("border-end-end-radius", "{{ $configuration->accordion_item_question_border_radius_bottomright }}px");



		$("#accordion_item_question_border_color," +
			"#accordion_item_question_border_top," +
			"#accordion_item_question_border_bottom," +
			"#accordion_item_question_border_bottom," +
			"#accordion_item_question_border_left," +
			"#accordion_item_question_border_right," +
			"#accordion_item_question_border_radius_topleft," +
			"#accordion_item_question_border_radius_topright," +
			"#accordion_item_question_border_radius_bottomleft," +
			"#accordion_item_question_border_radius_bottomright").on('input',
			function(e){
				$(".accordion-button.collapsed").css("border-color", $("#accordion_item_question_border_color").val());
				$(".accordion-button.collapsed").css("border-top", $("#accordion_item_question_border_top").val()+ "px solid "+ $("#accordion_item_question_border_color").val());
				$(".accordion-button.collapsed").css("border-bottom", $("#accordion_item_question_border_bottom").val() +"px solid "+ $("#accordion_item_question_border_color").val());
				$(".accordion-button.collapsed").css("border-left", $("#accordion_item_question_border_left").val() +"px solid "+ $("#accordion_item_question_border_color").val());
				$(".accordion-button.collapsed").css("border-right", $("#accordion_item_question_border_right").val() +"px solid "+ $("#accordion_item_question_border_color").val());
				$(".accordion-button.collapsed").css("border-start-start-radius", $("#accordion_item_question_border_radius_topleft").val() +"px");
				$(".accordion-button.collapsed").css("border-start-end-radius", $("#accordion_item_question_border_radius_topright").val() +"px");
				$(".accordion-button.collapsed").css("border-end-start-radius", $("#accordion_item_question_border_radius_bottomleft").val() +"px");
				$(".accordion-button.collapsed").css("border-end-end-radius", $("#accordion_item_question_border_radius_bottomright").val() +"px");

				$(".accordion-item:first-of-type").css("border-start-start-radius", parseInt($("#accordion_item_question_border_radius_topleft").val()) +3);
				$(".accordion-item:first-of-type").css("border-start-end-radius", parseInt($("#accordion_item_question_border_radius_topright").val()) +3);
				$(".accordion-item:first-of-type").css("border-end-start-radius", parseInt($("#accordion_item_question_border_radius_bottomleft").val()) +3);
				$(".accordion-item:first-of-type").css("border-end-end-radius", parseInt($("#accordion_item_question_border_radius_bottomright").val()) +3);

				$(".accordion-item:first-of-type .accordion-button.collapsed").css("border-start-start-radius", $("#accordion_item_question_border_radius_topleft").val() +"px");
				$(".accordion-item:first-of-type .accordion-button.collapsed").css("border-start-end-radius", $("#accordion_item_question_border_radius_topright").val() +"px");
				$(".accordion-item:first-of-type .accordion-button.collapsed").css("border-end-start-radius", $("#accordion_item_question_border_radius_bottomleft").val() +"px");
				$(".accordion-item:first-of-type .accordion-button.collapsed").css("border-end-end-radius", $("#accordion_item_question_border_radius_bottomright").val() +"px");

			});


  </script>
@endsection

