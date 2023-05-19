{% if section.settings.rjee_faqs_section_show_hide %}
<link rel="stylesheet" href="{{ 'component-rte.css' | asset_url }}" media="print" onload="this.media='all'">
<link rel="stylesheet" href="{{ 'section-main-page.css' | asset_url }}" media="print" onload="this.media='all'">
<link rel="stylesheet" href="{{ 'rjee_bs5.css' | asset_url }}" onload="this.media='all'">
<link rel="stylesheet" href="{{ 'Rjee_FAQ_font_awesome_solid.css' | asset_url }}">

{%- assign faqs_heading = section.settings -%}
{%- assign faqs = section.blocks -%}
{%- assign faqs_count = section.blocks.size -%}
{%- assign faqs_header_font = faqs_heading.rjee_faqs_header_text_font -%}
{%- assign faqs_accordian_font = faqs_heading.accordion_item_question_text_font -%}
{%- assign backslash__ = '\\' -%}
{%- assign accordion_item_question_non_collapse_icon = faqs_heading.accordion_item_question_non_collapse_icon -%}
{%- assign accordion_item_question_collapse_icon = faqs_heading.accordion_item_question_collapse_icon -%}

<style lang="scss">
    {{ faqs_header_font | font_face }}
    {{ faqs_accordian_font | font_face }}
</style>

<style>
    .accordion-button:not(.collapsed) {
        color: {{- faqs_heading.accordion_item_question_text_active_color -}} !important;
        background-color: {{- faqs_heading.accordion_item_question_background_active_color -}} !important;
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.125);
        border-radius: {{- faqs_heading.accordion_item_question_border_radius_after_topleft }}px {{ faqs_heading.accordion_item_question_border_radius_after_topright }}px {{ faqs_heading.accordion_item_question_border_radius_after_bottomright }}px {{ faqs_heading.accordion_item_question_border_radius_after_bottomleft -}}px !important;
        border-color: {{ faqs_heading.accordion_item_question_border_active_color -}} !important;
    }
    .accordion-button:not(.collapsed):focus {
        z-index: 3;
        border-color: {{- faqs_heading.accordion_item_question_border_color }} !important;
        outline: 0;
        box-shadow: 0 0 0 0.25rem {{ faqs_heading.accordion_item_question_border_color -}}4d !important;
    }
    .accordion-button{
        border-radius: {{- faqs_heading.accordion_item_question_border_radius_topleft }}px {{ faqs_heading.accordion_item_question_border_radius_topright }}px {{ faqs_heading.accordion_item_question_border_radius_bottomright }}px {{ faqs_heading.accordion_item_question_border_radius_bottomleft -}}px;
    }
    .accordion-button::after{
        flex-shrink: 0;
        width: 1.25rem;
        height: 1.25rem;
        margin-left: auto;
        background-image: url("data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==");
        font-family: "Font Awesome 6 Free";
        font-size: 35px;
        background-repeat: no-repeat;
        background-size: 1.25rem;
        transition: transform 0.2s ease-in-out;
        font-size: {{- faqs_heading.accordion_item_question_collapse_icon_font_size -}}px;
        line-height: {{- faqs_heading.accordion_item_question_collapse_icon_line_height -}}px;
        padding-left: {{- faqs_heading.accordion_item_question_collapse_icon_padding_left -}}px;
        padding-right: {{- faqs_heading.accordion_item_question_collapse_icon_padding_right -}}px;
        padding-top: {{- faqs_heading.accordion_item_question_collapse_icon_padding_top -}}px;
        padding-bottom: {{- faqs_heading.accordion_item_question_collapse_icon_padding_bottom -}}px;
        content: "\{{ accordion_item_question_collapse_icon }}";
    }
    .accordion-button:not(.collapsed)::after{
        background-image: url("data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==");
        font-family: "Font Awesome 6 Free";
        transform: rotate(0);
        font-size: {{- faqs_heading.accordion_item_question_non_collapse_icon_font_size -}}px;
        line-height: {{- faqs_heading.accordion_item_question_non_collapse_icon_line_height -}}px;
        padding-left: {{- faqs_heading.accordion_item_question_non_collapse_icon_padding_left -}}px;
        padding-right: {{- faqs_heading.accordion_item_question_non_collapse_icon_padding_right -}}px;
        padding-top: {{- faqs_heading.accordion_item_question_non_collapse_icon_padding_top -}}px;
        padding-bottom: {{- faqs_heading.accordion_item_question_non_collapse_icon_padding_bottom -}}px;
        content: "\{{- accordion_item_question_non_collapse_icon -}}";
    }
    .accordion-button:focus {
        z-index: 3;
        border-color: {{- faqs_heading.accordion_item_question_focus_color }};
        outline: 0;
        box-shadow: 0 0 0 0.25rem {{ faqs_heading.accordion_item_question_focus_color -}}4d !important;
    }

</style>

{% if faqs_count == 0 %}
<h1>Add FAQs Question-Answers.</h1>
{% else %}
<div
        class="rte container"
        style="
        height: {{- faqs_heading.rjee_faqs_background_height -}}vh;
        width: {{- faqs_heading.rjee_faqs_background_width -}}vw;
        background: {{- faqs_heading.rjee_faqs_background_color -}};
        margin-top: {{- faqs_heading.rjee_faqs_margin_top -}}px; margin-bottom: {{- faqs_heading.rjee_faqs_margin_bottom -}}px;
        padding-top: {{- faqs_heading.rjee_faqs_padding_top -}}px; padding-bottom: {{- faqs_heading.rjee_faqs_padding_bottom -}}px; padding-left: {{- faqs_heading.rjee_faqs_padding_left -}}px; padding-right: {{- faqs_heading.rjee_faqs_padding_right -}}px;
      "
>
    <h1 style="
          text-align: {{- faqs_heading.rjee_faqs_header_align_text -}};
          margin-top: {{- faqs_heading.rjee_faqs_header_text_margin_top -}}px;
          color:{{- faqs_heading.rjee_faqs_header_text_color -}};
          font-family:{{- faqs_header_font.family | replace: '"', "" -}}{{- "," -}}{{- faqs_header_font.fallback_families | replace: '"', "" -}};
          font-weight:{{- faqs_header_font.weight -}};
          font-style:{{- faqs_header_font.style -}};
          font-size:{{- faqs_heading.rjee_faqs_header_text_font_size }}px;
        "
    >
        {{- faqs_heading.rjee_faqs_header_text -}}
    </h1>
    <hr>
    <div class="accordion" id="rjee_faq_accordionExample">
        {% for faq in faqs %}
        <div
                class="accordion-item"
                style="
              margin-top: {{- faqs_heading.accordion_item_margin_top -}}px;
              margin-bottom: {{- faqs_heading.accordion_item_margin_bottom -}}px;
              margin-left: {{- faqs_heading.accordion_item_margin_left -}}px;
              margin-right: {{- faqs_heading.accordion_item_margin_right -}}px;
              border: {{- faqs_heading.accordion_item_question_border_size }}px solid {{ faqs_heading.accordion_item_question_border_color -}};
              border-radius: {{- faqs_heading.accordion_item_question_border_radius_topleft | plus: faqs_heading.accordion_item_question_border_size }}px {{ faqs_heading.accordion_item_question_border_radius_topright | plus: faqs_heading.accordion_item_question_border_size }}px {{ faqs_heading.accordion_item_question_border_radius_bottomright | plus: faqs_heading.accordion_item_question_border_size }}px {{ faqs_heading.accordion_item_question_border_radius_bottomleft | plus: faqs_heading.accordion_item_question_border_size -}}px;
            "
        >
            <h2 class="accordion-header" id="rjee_faq_question{{- forloop.index -}}">
                <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#rjee_faq_answer{{- forloop.index -}}"
                        aria-expanded="false"
                        aria-controls="rjee_faq_answer{{- forloop.index -}}"
                        style="background-color: {{- faqs_heading.accordion_item_question_background_color -}};
                  color: {{- faqs_heading.accordion_item_question_text_color -}};
                  {% comment %}border: {{- faqs_heading.accordion_item_question_border_size -}}px solid {{ faqs_heading.accordion_item_question_border_color -}};{% endcomment %}
                  border-radius: {{- faqs_heading.accordion_item_question_border_radius_topleft }}px {{ faqs_heading.accordion_item_question_border_radius_topright }}px {{ faqs_heading.accordion_item_question_border_radius_bottomright }}px {{ faqs_heading.accordion_item_question_border_radius_bottomleft -}}px;
                "
                >
                    <strong>{{- forloop.index -}}</strong>
                    <span style="font-family:{{- faqs_accordian_font.family | replace: '"', "" -}}{{- "," -}}{{- faqs_accordian_font.fallback_families | replace: '"', "" -}};
                    font-weight:{{- faqs_accordian_font.weight -}};
                    font-style:{{- faqs_accordian_font.style -}};
                    font-size:{{- faqs_heading.accordion_item_question_text_font_size -}}px;
                  "
                    >
                  {{- faq.settings.rjee_faqs_question_text -}}
                </span>

                </button>
            </h2>
            <div id="rjee_faq_answer{{- forloop.index -}}"
                    class="accordion-collapse collapse"
                    aria-labelledby="rjee_faq_question{{- forloop.index -}}"
                    data-bs-parent="#rjee_faq_accordionExample"
                    style="
                border-top-width: 0px;
                border-bottom-width: {{- faqs_heading.accordion_item_question_border_size -}}px;
                border-left-width: {{- faqs_heading.accordion_item_question_border_size -}}px;
                border-right-width: {{- faqs_heading.accordion_item_question_border_size -}}px;
                border-radius: 0px 0px {{ faqs_heading.accordion_item_question_border_radius_bottomright }}px {{ faqs_heading.accordion_item_question_border_radius_bottomleft -}}px;
              "
            >
                <div class="accordion-body">
                    {{- faq.settings.rjee_faqs_answer_text -}}
                </div>
            </div>
        </div>
        {% endfor %}
    </div>
</div>
{% endif -%}
<script type="text/javascript" src="{{ 'custom_popup_jquery.js' | asset_url }}"></script>
<script type="text/javascript" src="{{ 'rjee_bs5_bundle.js' | asset_url }}"></script>
<script type="text/javascript" src="{{ 'Rjee_FAQ_font_awesome.js' | asset_url }}"></script>
<script type="text/javascript" src="{{ 'Rjee_FAQ_font_awesome_solid.js' | asset_url }}"></script>
<script>
	setTimeout(()=>{
		$(".accordion-button").each( (element) => {
			if( $($(".accordion-button")[element]).attr("aria-expanded") == 'true' ){
				$($(".accordion-button")[element]).parent().parent().css("border-color", "{{- faqs_heading.accordion_item_question_border_active_color -}}");
			}else if( $($(".accordion-button")[element]).attr("aria-expanded") == 'false'){
				$($(".accordion-button")[element]).parent().parent().css("border-color", "{{- faqs_heading.accordion_item_question_border_color -}}");
			}
		});
	},1)
	$(".accordion-button").on("click", ()=>{
		$(".accordion-button").each( element => {
			if( $($(".accordion-button")[element]).attr("aria-expanded") == 'true' ){
				$($(".accordion-button")[element]).parent().parent().css("border-color", "{{- faqs_heading.accordion_item_question_border_active_color -}}");
			}else if( $($(".accordion-button")[element]).attr("aria-expanded") == 'false'){
				$($(".accordion-button")[element]).parent().parent().css("border-color", "{{- faqs_heading.accordion_item_question_border_color -}}");
			}
		});
	});
</script>
{% endif %}

{% schema %}
{
"blocks": [
{
"name": "FAQs Question-Answers",
"type": "section",
"settings": [
{
"type": "image_picker",
"id": "image",
"label": "Image"
},
{
"type": "text",
"id": "rjee_faqs_question_text",
"label": "FAQ Question Heading",
"default": "[ORDER/PAYMENT/CANCELLATION] HOW DO I CANCEL OR CHANGE AN ORDER?",
"info": "FAQ Question Heading text to display."
},
{
"type": "richtext",
"id": "rjee_faqs_answer_text",
"label": "FAQ Answer Text",
"info": "FAQ Answer text to display."
}
]
}
],
"class": "rjee-faqs-section",
"enabled_on": {
"templates": [
"*"
]
},
"name": "Rjee FAQ Section",
"presets": [
{
"name": "Rjee FAQ Section",
"category": "FAQs"
}
],
"settings": [
{
"type": "header",
"content": "Enable/ Disable"
},
{
"type": "checkbox",
"id": "rjee_faqs_section_show_hide",
"label": "Show Rjee FAQ Section",
"default": true,
"info": "Enable/Disable FAQs section."
},
{
"type": "header",
"content": "Background"
},
{
"type": "color_background",
"id": "rjee_faqs_background_color",
"label": "Background color",
"default": "rgba(0,0,0,0)"
},
{
"type": "header",
"content": "Margins"
},
{
"type": "range",
"id": "rjee_faqs_margin_top",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Margin Top",
"default": 10
},
{
"type": "range",
"id": "rjee_faqs_margin_bottom",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Margin Bottom",
"default": 10
},
{
"type": "range",
"id": "rjee_faqs_margin_left",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Margin Left",
"default": 10
},
{
"type": "range",
"id": "rjee_faqs_margin_right",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Margin Right",
"default": 10
},
{
"type": "header",
"content": "Paddings"
},
{
"type": "range",
"id": "rjee_faqs_padding_top",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Padding Top",
"default": 20
},
{
"type": "range",
"id": "rjee_faqs_padding_bottom",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Padding Bottom",
"default": 20
},
{
"type": "range",
"id": "rjee_faqs_padding_left",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Padding Left",
"default": 20
},
{
"type": "range",
"id": "rjee_faqs_padding_right",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Padding Right",
"default": 20
},
{
"type": "header",
"content": "Header Typography"
},
{
"type": "text",
"id": "rjee_faqs_header_text",
"label": "Header Text",
"default": "FAQ > ORDER/PAYMENT/CANCELLATION",
"info": "Header text to display."
},
{
"type": "color",
"id": "rjee_faqs_header_text_color",
"label": "Header Text color",
"default": "#000000"
},
{
"type": "font_picker",
"id": "rjee_faqs_header_text_font",
"label": "Header Text font",
"default": "helvetica_n4"
},
{
"type": "range",
"id": "rjee_faqs_header_text_font_size",
"min": 12,
"max": 46,
"step": 1,
"unit": "px",
"label": "Font size",
"default": 24
},
{
"type": "select",
"id": "rjee_faqs_header_align_text",
"label": "Text alignment",
"default": "left",
"options": [
{
"value": "left",
"label": "Left"
},
{
"value": "center",
"label": "Centered"
},
{
"value": "right",
"label": "Right"
}
]
},
{
"type": "header",
"content": "Header Margins"
},
{
"type": "range",
"id": "rjee_faqs_header_text_margin_top",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Margin Top",
"default": 20
},
{
"type": "range",
"id": "rjee_faqs_header_text_margin_bottom",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Margin Bottom",
"default": 0
},
{
"type": "range",
"id": "rjee_faqs_header_text_margin_left",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Margin Left",
"default": 0
},
{
"type": "range",
"id": "rjee_faqs_header_text_margin_right",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Margin Right",
"default": 0
},
{
"type": "header",
"content": "Header Paddings"
},
{
"type": "range",
"id": "rjee_faqs_header_text_padding_top",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Padding Top",
"default": 0
},
{
"type": "range",
"id": "rjee_faqs_header_text_padding_bottom",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Padding Bottom",
"default": 10
},
{
"type": "range",
"id": "rjee_faqs_header_text_padding_left",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Padding Left",
"default": 10
},
{
"type": "range",
"id": "rjee_faqs_header_text_padding_right",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Padding Right",
"default": 10
},
{
"type": "header",
"content": "FAQ Tabs Typography"
},
{
"type": "color",
"id": "rjee_faqs_question_text_color",
"label": "Text color",
"default": "#000000"
},
{
"type": "font_picker",
"id": "rjee_faqs_question_text_font",
"label": "Text font",
"default": "helvetica_n4"
},
{
"type": "range",
"id": "rjee_faqs_question_text_font_size",
"min": 12,
"max": 46,
"step": 1,
"unit": "px",
"label": "Font size",
"default": 24
},
{
"type": "select",
"id": "rjee_faqs_question_align_text",
"label": "Text alignment",
"default": "left",
"options": [
{
"value": "left",
"label": "Left"
},
{
"value": "center",
"label": "Centered"
},
{
"value": "right",
"label": "Right"
}
]
},
{
"type": "header",
"content": "FAQ Tabs Margin"
},
{
"type": "range",
"id": "accordion_item_margin_top",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Margin Top",
"default": 0
},
{
"type": "range",
"id": "accordion_item_margin_bottom",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Margin Bottom",
"default": 5
},
{
"type": "range",
"id": "accordion_item_margin_left",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Margin Left",
"default": 20
},
{
"type": "range",
"id": "accordion_item_margin_right",
"min": 0,
"max": 100,
"step": 1,
"unit": "px",
"label": "Margin Right",
"default": 20
},
{
"type": "header",
"content": "FAQ Tabs Background/ Style"
},
{
"type": "paragraph",
"content": "Background"
},
{
"type": "color",
"id": "accordion_item_question_background_color",
"label": "Background color",
"default": "#F3A829"
},
{
"type": "color",
"id": "accordion_item_question_background_active_color",
"label": "Active Background color",
"default": "#FCEACC"
},
{
"type": "paragraph",
"content": "Typography"
},
{
"type": "color",
"id": "accordion_item_question_text_color",
"label": "Text color",
"default": "#FFFFFF"
},
{
"type": "color",
"id": "accordion_item_question_text_active_color",
"label": "Active Text color",
"default": "#000000"
},
{
"type": "font_picker",
"id": "accordion_item_question_text_font",
"label": "Text font",
"default": "helvetica_n4"
},
{
"type": "range",
"id": "accordion_item_question_text_font_size",
"min": 12,
"max": 46,
"step": 1,
"unit": "px",
"label": "Font size",
"default": 14
},
{
"type": "paragraph",
"content": "Border"
},
{
"type": "color",
"id": "accordion_item_question_border_color",
"label": "Border color",
"default": "#FFFFFF"
},
{
"type": "color",
"id": "accordion_item_question_border_active_color",
"label": "Active Border color",
"default": "#000000"
},
{
"type": "color",
"id": "accordion_item_question_focus_color",
"label": "Focus color",
"default": "#FFFFFF"
},
{
"type": "range",
"id": "accordion_item_question_border_size",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Border size",
"default": 1
},
{
"type": "paragraph",
"content": "Border Radius"
},
{
"type": "range",
"id": "accordion_item_question_border_radius_topleft",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Top-left Radius",
"default": 0
},
{
"type": "range",
"id": "accordion_item_question_border_radius_topright",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Top-right Radius",
"default": 0
},
{
"type": "range",
"id": "accordion_item_question_border_radius_bottomleft",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Bottom-right Radius",
"default": 0
},
{
"type": "range",
"id": "accordion_item_question_border_radius_bottomright",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Bottom-right Radius",
"default": 0
},
{
"type": "paragraph",
"content": "Border Radius After"
},
{
"type": "range",
"id": "accordion_item_question_border_radius_after_topleft",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Top-left Radius",
"default": 0
},
{
"type": "range",
"id": "accordion_item_question_border_radius_after_topright",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Top-right Radius",
"default": 0
},
{
"type": "range",
"id": "accordion_item_question_border_radius_after_bottomleft",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Bottom-right Radius",
"default": 0
},
{
"type": "range",
"id": "accordion_item_question_border_radius_after_bottomright",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Bottom-right Radius",
"default": 0
},
{
"type": "paragraph",
"content": "Accordion signs"
},
{
"type": "select",
"id": "accordion_item_question_collapse_icon_align",
"label": "Collapse Icons alignment",
"default": "right",
"options": [
{
"value": "left",
"label": "Left"
},
{
"value": "right",
"label": "Right"
}
]
},
{
"type": "select",
"id": "accordion_item_question_collapse_icon",
"label": "Select Collapse Icons",
"options": [
{
"value": "f107",
"label": "angles-down"
},
{
"value": "2b",
"label": "Plus"
},
{
"value": "f00c",
"label": "Check"
},
{
"value": "f058",
"label": "Circle-check"
},
{
"value": "f14a",
"label": "Square-check"
},
{
"value": "f103",
"label": "angle-down"
}
],
"default": "f107"
},
{
"type": "select",
"id": "accordion_item_question_non_collapse_icon",
"label": "Select Non-Collapse Icons",
"options": [
{
"value": "f106",
"label": "angle-up"
},
{
"value": "f068",
"label": "minus"
},
{
"value": "f00d",
"label": "x-mark"
},
{
"value": "f057",
"label": "x-mark-circle"
},
{
"value": "f2d3",
"label": "x-mark-square"
},
{
"value": "f102",
"label": "angles-up"
}
],
"default": "f106"
},
{
"type": "range",
"id": "accordion_item_question_collapse_icon_font_size",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Collapse Icon Font-Size",
"default": 24
},
{
"type": "range",
"id": "accordion_item_question_collapse_icon_line_height",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Collapse Icon Line-height",
"default": 9
},
{
"type": "range",
"id": "accordion_item_question_collapse_icon_padding_left",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Collapse Icon Padding-left",
"default": 2
},
{
"type": "range",
"id": "accordion_item_question_collapse_icon_padding_right",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Collapse Icon Padding-right",
"default": 5
},
{
"type": "range",
"id": "accordion_item_question_collapse_icon_padding_top",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Collapse Icon Padding-top",
"default": 2
},
{
"type": "range",
"id": "accordion_item_question_collapse_icon_padding_bottom",
"min": 0,
"max": 30,
"step": 1,
"unit": "px",
"label": "Collapse Icon Padding-bottom",
"default": 2
}
],
"tag": "div"
}
{% endschema %}
