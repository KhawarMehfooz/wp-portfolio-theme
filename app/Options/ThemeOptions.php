<?php

namespace App\Options;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Options as Field;

class ThemeOptions extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'Theme Options';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'Theme Options | Options';

    /**
     * The option page field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('theme_options');

        $fields
            ->addTab('project_archive_page_settings')
            ->addText('archive_description', [
                'default_value' => 'A collection of web development projects and case studies showcasing technical solutions, challenges overcome, and measurable results delivered for clients.'
            ])
            ->addTab('service_archive_page_settings')
            ->addText('service_archive_description', [
                'default_value' => 'Comprehensive web development services tailored to your needs. From initial concept to final deployment, I provide end-to-end solutions that deliver results.'
            ])
            ->addTab('contact_form_block_settings')
            ->addEmail('contact_form_sender_email', [
                'label' => 'Sender Email',
                'instructions' => 'This email will be used as the sender address.',
                'default_value' => get_bloginfo('admin_email'),
            ])
            ->addEmail('contact_form_receiver_email', [
                'label' => 'Receiver Email',
                'instructions' => 'This email will be used as the receiver address.',
            ])
            ->addTrueFalse('enable_captcha', [
                'label' => 'Enable Captcha?',
                'ui' => 1,
            ])
            ->addText('captcha_site_key', [
                'label' => 'Cloudflare Site Key',
                'instructions' => 'Get this from your Cloudflare Turnstile dashboard.',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'enable_captcha',
                            'operator' => '==',
                            'value' => 1,
                        ],
                    ],
                ],
            ])
            ->addText('captcha_secret_key', [
                'label' => 'Cloudflare Secret Key',
                'instructions' => 'Used for server-side verification.',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'enable_captcha',
                            'operator' => '==',
                            'value' => 1,
                        ],
                    ],
                ],
            ]);



        return $fields->build();
    }
}
