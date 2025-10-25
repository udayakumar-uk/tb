
<script src="https://cdn.tiny.cloud/1/ub2r3tiv25n69bfq8lq94cgcuh538461d76xjih1bqa1671x/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

<script>
    tinymce.init({
        
        selector: '#description, #hdescription, #content, #hcontent, #horder_details',
        // Import Google Fonts directly into the editor's content
        content_style: `
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
            body { font-family: Inter, sans-serif; }
        `,

        // Define available fonts (include your Google Fonts)
        font_family_formats:  "Inter=Inter, sans-serif; Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",

        plugins: [
        // Core editing features
        'anchor', 'image', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        // Your account includes a free trial of TinyMCE premium features
        // Try the most popular premium features until Sep 28, 2025:
        'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'advtemplate', 'ai', 'uploadcare', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | forecolor backcolor | bold italic underline strikethrough link | image table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ],
        branding: false,
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
        uploadcare_public_key: '37c1cfcfa4e9a140206c',
    });

</script>


<script>
tinymce.init({
  selector: '#description, #hdescription, #content, #hcontent, #horder_details',

  // Import Google Fonts directly into the editor's content
  content_style: `
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
    body { font-family: Inter, sans-serif; }
  `,

  // Define available fonts (include your Google Fonts)
  font_family_formats:  "Inter=Inter, sans-serif; Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",

  plugins: [
    'anchor', 'image', 'autolink', 'charmap', 'codesample', 'emoticons',
    'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks',
    'wordcount', 'checklist', 'casechange', 'formatpainter', 'pageembed',
    'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste',
    'advtable', 'advcode', 'advtemplate', 'uploadcare', 'mentions',
    'tableofcontents', 'footnotes', 'mergetags', 'autocorrect',
    'typography', 'inlinecss', 'markdown', 'importword', 'exportword', 'exportpdf'
  ],

  toolbar:
    'undo redo | blocks fontfamily fontsize | forecolor backcolor | bold italic underline strikethrough link | ' +
    'image table mergetags | spellcheckdialog a11ycheck typography uploadcare | align lineheight | ' +
    'checklist numlist bullist indent outdent | emoticons charmap | removeformat',

  menubar: false,
  branding: false,

  // Optional: comments/mentions setup
  tinycomments_mode: 'embedded',
  tinycomments_author: 'Author name',

  // Optional: Uploadcare
  uploadcare_public_key: '37c1cfcfa4e9a140206c'
});
</script>