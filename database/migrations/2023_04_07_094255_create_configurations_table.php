<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('shop_url')->nullable()->default('NULL');
            $table->smallInteger('send_email_welcome')->default(1);
            $table->smallInteger('verified_email')->default(1);
            $table->boolean('webhook_status')->default(0);
            $table->string('theme_id')->default('NULL');
            $table->boolean('script_tag_status')->default(0);
            $table->boolean('themepublish_assets_status')->default(0);
            $table->boolean('status')->default(0);
            $table->string('shopify_scripttag_id')->default("null");

            /* Configuration page Settings */

            $table->boolean('is_enabled')->default(0);
            $table->string('rjee_faqs_background_color')->default("#FFFFFF");

            // margin
            $table->integer('rjee_faqs_section_margin_top')->default(60);
            $table->integer('rjee_faqs_section_margin_bottom')->default(30);
            $table->integer('rjee_faqs_section_margin_left')->default(10);
            $table->integer('rjee_faqs_section_margin_right')->default(10);

            // margin md
            $table->integer('rjee_faqs_section_margin_top_md')->default(10);
            $table->integer('rjee_faqs_section_margin_bottom_md')->default(10);
            $table->integer('rjee_faqs_section_margin_left_md')->default(10);
            $table->integer('rjee_faqs_section_margin_right_md')->default(10);

            // margin xs
            $table->integer('rjee_faqs_section_margin_top_xs')->default(10);
            $table->integer('rjee_faqs_section_margin_bottom_xs')->default(10);
            $table->integer('rjee_faqs_section_margin_left_xs')->default(10);
            $table->integer('rjee_faqs_section_margin_right_xs')->default(10);

            // padding
            $table->integer('rjee_faqs_section_padding_top')->default(10);
            $table->integer('rjee_faqs_section_padding_bottom')->default(10);
            $table->integer('rjee_faqs_section_padding_left')->default(10);
            $table->integer('rjee_faqs_section_padding_right')->default(10);

            // padding md
            $table->integer('rjee_faqs_section_padding_top_md')->default(10);
            $table->integer('rjee_faqs_section_padding_bottom_md')->default(10);
            $table->integer('rjee_faqs_section_padding_left_md')->default(10);
            $table->integer('rjee_faqs_section_padding_right_md')->default(10);

            // padding xs
            $table->integer('rjee_faqs_section_padding_top_xs')->default(10);
            $table->integer('rjee_faqs_section_padding_bottom_xs')->default(10);
            $table->integer('rjee_faqs_section_padding_left_xs')->default(10);
            $table->integer('rjee_faqs_section_padding_right_xs')->default(10);

            //Faq Header Typography | Title Typography
            $table->string('rjee_faqs_title')->default('ORDER/PAYMENT/CANCELLATION] HOW DO I CANCEL OR CHANGE AN ORDER?');
            $table->string('rjee_faqs_header_text_font')->default('Roboto');
            $table->string('rjee_faqs_header_text_color')->default('#000000');
            $table->integer('rjee_faqs_header_text_font_size')->default(18);
            $table->string('rjee_faqs_header_align_text')->default('center');

            //Faq Header Typography | Sub Title Typography
            $table->string('rjee_faqs_sub_title')->default('Section Sub Title Here');
            $table->string('rjee_faqs_header_sub_text_font')->default('Roboto');
            $table->string('rjee_faqs_header_sub_text_color')->default('#000000');
            $table->integer('rjee_faqs_header_sub_text_font_size')->default(24);
            $table->string('rjee_faqs_header_align_sub_text')->default('center');

//            $table->integer('accordion_item_margin_top')->default(0);
//            $table->integer('accordion_item_margin_bottom')->default(0);
//            $table->integer('accordion_item_margin_left')->default(0);
//            $table->integer('accordion_item_margin_right')->default(0);

//            $table->string('accordion_item_question_background_color')->nullable();
//            $table->string('accordion_item_question_background_active_color')->nullable();

            //Accordian Typography | Question Typography
            $table->integer('accordion_item_faq_gap')->default(0);

            $table->string('accordion_item_question_text_color')->default('NULL');
            $table->string('accordion_item_question_text_active_color')->default('NULL');
            $table->integer('accordion_item_question_text_font_size')->default(14);
            $table->string('accordion_item_question_text_font')->default('Roboto');
            $table->string('accordion_item_question_align_text')->default('left');

            //Accordian Typography | Answer Typography
            $table->string('accordion_item_answer_text_color')->default('NULL');
            $table->string('accordion_item_answer_text_font')->default("Roboto");
            $table->integer('accordion_item_answer_text_font_size')->default(14);
            $table->string('accordion_item_answer_align_text')->default('left');

            //Border color Settings
            $table->string('accordion_item_question_border_color')->default('NULL');
            $table->string('accordion_item_question_border_active_color')->default('NULL');
            $table->string('accordion_item_question_focus_color')->default('NULL');

            //Border Radius
            $table->integer('accordion_item_question_border_size')->default(1);
            $table->integer('accordion_item_question_border_radius_topleft')->default(0);
            $table->integer('accordion_item_question_border_radius_topright')->default(0);
            $table->integer('accordion_item_question_border_radius_bottomleft')->default(0);
            $table->integer('accordion_item_question_border_radius_bottomright')->default(0);

            //Border Width
            $table->integer('accordion_item_question_border_top')->default(0);
            $table->integer('accordion_item_question_border_bottom')->default(0);
            $table->integer('accordion_item_question_border_left')->default(0);
            $table->integer('accordion_item_question_border_right')->default(0);


            //Border Radius After
            $table->integer('accordion_item_question_border_radius_after_topleft')->default(0);
            $table->integer('accordion_item_question_border_radius_after_topright')->default(0);
            $table->integer('accordion_item_question_border_radius_after_bottomleft')->default(0);
            $table->integer('accordion_item_question_border_radius_after_bottomright')->default(0);

            //Accordion signs
            $table->string('accordion_item_question_collapse_icon_align')->default('NULL');
            $table->string('accordion_item_question_collapse_icon')->default('f107');
            $table->string('accordion_item_question_non_collapse_icon')->default('f106');
            $table->integer('accordion_item_question_collapse_icon_font_size')->default(24);
            $table->integer('accordion_item_question_collapse_icon_line_height')->default(9);
            $table->integer('accordion_item_question_collapse_icon_padding_left')->default(2);
            $table->integer('accordion_item_question_collapse_icon_padding_right')->default(5);
            $table->integer('accordion_item_question_collapse_icon_padding_top')->default(2);
            $table->integer('accordion_item_question_collapse_icon_padding_bottom')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}
