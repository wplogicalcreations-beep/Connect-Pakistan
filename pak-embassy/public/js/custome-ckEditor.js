// Initialize CKEditor with an extended toolbar
ClassicEditor.create(document.querySelector("#editor"), {
  toolbar: [
    "undo",
    "redo",
    "|",
    "heading",
    "styles",
    "|",
    "bold",
    "italic",
    "underline",
    "strikethrough",
    "|",
    "fontColor",
    "fontBackgroundColor",
    "|",
    "link",
    "imageUpload",
    "|",
    "insertTable",
    "blockQuote",
    "|",
    "alignment",
    "|",
    "specialCharacters",
    "|",
    "bulletedList",
    "numberedList",
    "|",
    "indent",
    "outdent",
  ],
  heading: {
    options: [
      { model: "paragraph", title: "Paragraph", class: "ck-heading_paragraph" },
      {
        model: "heading1",
        view: "h1",
        title: "Heading 1",
        class: "ck-heading_heading1",
      },
      {
        model: "heading2",
        view: "h2",
        title: "Heading 2",
        class: "ck-heading_heading2",
      },
      {
        model: "heading3",
        view: "h3",
        title: "Heading 3",
        class: "ck-heading_heading3",
      },
    ],
  },
  alignment: {
    options: ["left", "center", "right", "justify"],
  },
  table: {
    contentToolbar: [
      "tableColumn",
      "tableRow",
      "mergeTableCells",
      "tableProperties",
      "tableCellProperties",
    ],
  },
  fontColor: {
    colors: [
      { color: "#FF0000", label: "Red" },
      { color: "#00FF00", label: "Green" },
      { color: "#0000FF", label: "Blue" },
      { color: "#000000", label: "Black" },
      { color: "#FFFFFF", label: "White" },
    ],
  },
  fontBackgroundColor: {
    colors: [
      { color: "#FFFF00", label: "Yellow" },
      { color: "#FFA500", label: "Orange" },
      { color: "#FFC0CB", label: "Pink" },
      { color: "#ADD8E6", label: "Light Blue" },
      { color: "#90EE90", label: "Light Green" },
    ],
  },
  image: {
    toolbar: [
      "imageTextAlternative",
      "imageStyle:inline",
      "imageStyle:block",
      "imageStyle:side",
    ],
  },
  specialCharacters: {
    categories: [
      {
        title: "Arrows",
        characters: ["→", "←", "↑", "↓", "↔"],
      },
      {
        title: "Mathematical",
        characters: ["∑", "√", "∞", "≈", "≠"],
      },
    ],
  },
})
  .then((editor) => {
    const wordCountElement = document.getElementById("wordCount");
    const charCountElement = document.getElementById("charCount");

    // Update word and character count
    editor.model.document.on("change:data", () => {
      const text = editor.getData().replace(/<[^>]*>/g, ""); // Remove HTML tags
      const words = text.trim().split(/\s+/).filter(Boolean);
      const chars = text.length;

      wordCountElement.innerText = words.length;
      charCountElement.innerText = chars;
    });
  })
  .catch((error) => {
    console.error(error);
  });
