<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-hoverintent@1.10.1/jquery.hoverIntent.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.3.0/flickity.pkgd.min.js"></script>


<script src="{{ asset('frontend/assets/js/main.js') }}"></script>
<script src="{{ asset('frontend/assets/js/common.js') }}"></script>

<script src=" {{ asset('frontend/assets/js/script.js') }}"></script>

<script src="{{ asset('frontend/assets/js/litespeed/4.js') }}"></script>
<script src="{{ asset('frontend/assets/js/litespeed/6.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.wpcf7-form').on('submit', function(e) {
            e.preventDefault();

            let $form = $(this);
            let $responseOutput = $form.find('.wpcf7-response-output');
            let submitBtn = $form.find('#btn-submit');
            let spinner = $form.find('.wpcf7-spinner');

            // Reset trạng thái ban đầu
            $responseOutput.removeClass('wpcf7-mail-sent-ok wpcf7-validation-errors').hide();
            $form.find('.form-control').removeClass('is-invalid');
            $form.find('.wpcf7-not-valid-tip').remove();
            spinner.show();

            $.ajax({
                url: '{{ route('post.contact') }}', // ⚠️ Thay bằng route lưu vào database Laravel của bạn
                method: 'POST',
                data: $form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(response) {
                    spinner.hide();
                    $form[0].reset();
                    $responseOutput
                        .addClass('wpcf7-mail-sent-ok')
                        .text("Cảm ơn bạn đã liên hệ, chúng tôi sẽ phản hồi sớm nhất.")
                        .show();
                },
                error: function(xhr) {
                    spinner.hide();

                    // Xóa các thông báo lỗi cũ
                    $form.find('.wpcf7-not-valid-tip').remove();
                    $form.find('.is-invalid').removeClass('is-invalid');

                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            let input = $form.find('[name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.after('<span class="wpcf7-not-valid-tip">' +
                                value[0] + '</span>');
                        });
                        $responseOutput
                            .addClass('wpcf7-validation-errors')
                            .text("Vui lòng kiểm tra lại các trường thông tin.")
                            .show();
                    } else if (xhr.status === 429) {
                        console.log(xhr);

                        const errorMsg = xhr.responseJSON.errors.general[0] ??
                            "Bạn đang gửi quá nhiều yêu cầu. Vui lòng thử lại sau.";
                        $responseOutput
                            .addClass('wpcf7-validation-errors')
                            .text(errorMsg)
                            .show();
                        console.log($responseOutput);

                    } else {
                        $responseOutput
                            .addClass('wpcf7-validation-errors')
                            .text("Đã xảy ra lỗi không xác định.")
                            .show();
                    }
                }
            });
        });
    });
</script>

@stack('scripts')
