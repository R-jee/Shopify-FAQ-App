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

$("#rjee_faqs_header_text_font").on("change", function (){



});

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



{{----------------------------- End preview  SECTION  input Fields Settings Code-----------------------------}}
function colorChange(){}