import Editor from '@tinymce/tinymce-vue';
import tinymce from 'tinymce/tinymce';

// Default icons are required for TinyMCE 5.3 or above
import 'tinymce/icons/default';

/* Required TinyMCE components */
import 'tinymce/themes/silver';

/* Import a skin (can be a custom skin instead of the default) */
import 'tinymce/skins/ui/oxide/skin.css';

// Any plugins you want to use has to be imported
import 'tinymce/plugins/link';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/image';
import 'tinymce/plugins/anchor';
import 'tinymce/plugins/wordcount';
import 'tinymce/plugins/media';

import 'tinymce/plugins/advList';
import 'tinymce/plugins/autolink';
import 'tinymce/plugins/charmap';
import 'tinymce/plugins/preview';
import 'tinymce/plugins/pagebreak';
import 'tinymce/plugins/searchreplace';

/* content UI CSS is required */
import contentUiSkinCss from 'tinymce/skins/ui/oxide/content.css?inline';

/* The default content CSS can be changed or replaced with appropriate CSS for the editor content. */
import contentCss from 'tinymce/skins/content/default/content.css?inline';