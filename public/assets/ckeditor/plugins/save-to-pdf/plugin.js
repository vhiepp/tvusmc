CKEDITOR.plugins.add('save-to-pdf', {
    icons: 'save-to-pdf',
    init: function (editor) {
        editor.addCommand('save-to-pdf', {
            exec: function (editor) {

                $.ajax({
                    url: editor.config.pdfHandler,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        content: editor.getData(),
                        name: $('#inputTitle').val() ? $('#inputTitle').val() : 'savetopdf',
                    },
                    success: function (data) {
                        console.log(data);

                        if (data.pdfUrl) {
                            window.location.href = data.pdfUrl;
                        } else {
                            alert('Có lỗi xảy ra! Không thể tải xuống file PDF vào lúc này!!');
                        }

                    }
                });

                document.body.style.cursor = 'wait';

            }
        });
        editor.ui.addButton('save-to-pdf', {
            label: 'Save as PDF',
            command: 'save-to-pdf',
            toolbar: 'tools'
        });
    }
});