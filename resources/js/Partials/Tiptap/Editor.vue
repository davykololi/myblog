<template>
  <v-app id="app">
    <v-container class="prose prose-lg">
      <VuetifyTiptap v-model="content" @input="$emit('update:content',$event.target.value)" :label="label" rounded :min-height="200" :max-height="465" :max-width="1100" :extensions="extensions" />
    </v-container>
  </v-app>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { BaseKit, Bold, Color, Fullscreen, Heading, Highlight, TextAlign, FontFamily, FontSize, SubAndSuperScript, BulletList, OrderedList, TaskList, MarkdownTheme, Indent, History, Image, Italic, Link, Strike, Table, Underline, Video, Blockquote, HorizontalRule, Code, CodeBlock, VuetifyTiptap, VuetifyViewer } from 'vuetify-pro-tiptap';
import 'vuetify-pro-tiptap/style.css'

const extensions = [
  BaseKit.configure({
    placeholder: {
      placeholder: 'Enter some text...'
    },
  }),
  Bold,
  Italic,
  Underline,
  Strike,
  Color,
  Highlight,
  Heading,
  TextAlign,
  FontFamily,
  FontSize,
  SubAndSuperScript,
  OrderedList,
  TaskList,
  BulletList,
  MarkdownTheme,
  Indent,
  Link,
  Image,
  Video,
  Table,
  History,
  Blockquote,
  HorizontalRule,
  Code,
  CodeBlock,
  Fullscreen,
]


const content = defineModel();
const label = "Enter/Paste Content Here";
</script>
