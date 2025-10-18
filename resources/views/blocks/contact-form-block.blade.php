@unless ($block->preview)
    <section {{ $attributes->merge(['class' => 'px-6 border-b border-border/50']) }}>
    @else
        <section class="pt-7 px-6">
        @endunless
        <div class="container mx-auto py-10 md:border-l md:border-r border-border/50">
            <form id="contactForm" method="POST"
                class="space-y-6 max-w-2xl mx-auto border border-dashed-subtle-default p-6">
                @php wp_nonce_field('handle_contact_form', 'contact_form_nonce'); @endphp
                <input type="hidden" name="action" value="handle_contact_form_ajax">
                @if (!empty($items['enable_header']))
                    <div class="mb-6">
                        <h2
                            class="font-display {{ !empty($items['header_alignment']) && $items['header_alignment'] == 1 ? 'text-center' : 'text-left' }} text-2xl md:text-4xl font-bold mb-4">
                            {{ $items['contact_form_heading'] ?? '' }}
                        </h2>
                        @if (!empty($items['contact_form_description']))
                            <p
                                class="text-muted-foreground leading-relaxed text-sm md:text-lg {{ !empty($items['header_alignment']) && $items['header_alignment'] == 1 ? 'text-center' : 'text-left' }}">
                                {{ $items['contact_form_description'] }}
                            </p>
                        @endif
                    </div>
                @endif

                <div>
                    <label for="name" class=" font-display block text-sm font-medium mb-2">Name<sup
                            class="text-destructive">*</sup></label>
                    <input type="text"
                        class="font-display flex h-10 w-full border bg-background px-3 py-2 text-base text-foreground placeholder:text-muted-foreground border-dashed-subtle-default focus:border-primary focus:outline-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                        id="name" required name="name" />

                </div>
                <div>
                    <label for="email" class="font-display block text-sm font-medium mb-2">Email<sup
                            class="text-destructive">*</sup></label>
                    <input type="email"
                        class="font-display flex h-10 w-full border bg-background px-3 py-2 text-base text-foreground placeholder:text-muted-foreground border-dashed-subtle-default focus:border-primary focus:outline-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                        id="email" required name="email" />
                </div>
                <div>
                    <label for="message" class="font-display block text-sm font-medium mb-2">Message<sup
                            class="text-destructive">*</sup></label>
                    <textarea name="message" id="message" required rows="6"
                        class="flex min-h-[80px] w-full border bg-background px-3 py-2 text-sm text-foreground placeholder:text-muted-foreground border-dashed-subtle-default focus:border-primary focus:outline-none disabled:cursor-not-allowed disabled:opacity-50 resize-none"></textarea>

                </div>

                <div id="captchaMessageContainer">
                    @if (get_field('enable_captcha', 'option'))
                        <div class="cf-turnstile" data-sitekey="{{ get_field('captcha_site_key', 'option') }}"
                            data-theme="light" data-size="normal">
                        </div>
                    @endif
                    <div id="formMessage" class="hidden font-display text-sm p-3 rounded border"></div>
                </div>

                <button
                    class="font-display resize-none inline-flex items-center justify-center gap-2 whitespace-nowrap  text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 cursor-pointer bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full"
                    type="submit">Send Message</button>
            </form>
            <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
            <script>
                (function($) {
                    'use strict';

                    $(document).ready(function() {
                        $('#contactForm').on('submit', function(e) {
                            e.preventDefault();

                            let $form = $(this);
                            let formData = $form.serialize();
                            let $messageDiv = $('#formMessage');
                            let $captcha = $('.cf-turnstile');

                            $messageDiv.removeClass(
                                    'hidden text-green-600 text-red-600 bg-green-50 bg-red-50 border-green-200 border-red-200'
                                    )
                                .addClass('text-blue-600 bg-blue-50 border-blue-200')
                                .text('Sending...');

                            $.ajax({
                                url: "{{ admin_url('admin-ajax.php') }}",
                                type: "POST",
                                data: formData,
                                dataType: "json",
                                success: function(response) {
                                    if (response.success) {
                                        $captcha.hide();

                                        $messageDiv.removeClass(
                                                'hidden text-blue-600 text-red-600 bg-blue-50 bg-red-50 border-blue-200 border-red-200'
                                                )
                                            .addClass('text-green-600 bg-green-50 border-green-200')
                                            .text(
                                                "Thank you for contacting, I'll get back to you as soon as possible."
                                                );

                                        $form.trigger('reset');

                                        if (typeof turnstile !== 'undefined') {
                                            turnstile.reset();
                                        }
                                    } else {
                                        $messageDiv.removeClass(
                                                'hidden text-blue-600 text-green-600 bg-blue-50 bg-green-50 border-blue-200 border-green-200'
                                                )
                                            .addClass('text-red-600 bg-red-50 border-red-200')
                                            .text(response.data || 'Something went wrong.');
                                    }
                                },
                                error: function() {
                                    $messageDiv.removeClass(
                                            'hidden text-blue-600 text-green-600 bg-blue-50 bg-green-50 border-blue-200 border-green-200'
                                            )
                                        .addClass('text-red-600 bg-red-50 border-red-200')
                                        .text('Error submitting the form. Please try again.');
                                }
                            });
                        });
                    });
                })(jQuery);
            </script>

        </div>
    </section>

    @unless ($block->preview)
        </div>
    @endunless
