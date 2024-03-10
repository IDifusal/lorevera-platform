<template>
    <editor-content :editor="editor" />
</template>
<script setup>
import { useEditor, EditorContent } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";
const editor = useEditor({
    content: "<p>Content <strong> add here</strong> TESTING</p>",
    extensions: [StarterKit],
});
</script>
<style>
.tiptap.ProseMirror {
    padding: 20px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    background-color: #e2e8f0;
}
.tiptap ul {
    list-style: inside;
}
</style>