//show uploaded image
// function imagePreview() {
//     const fileInput = document.getElementById("image");
//     const file = fileInput.files[0];
//     if (file && file.size > 2 * 1024 * 1024) { // 2MB in bytes
//         alert('Error: Image file size exceeds 2MB.');
//         fileInput.value = ''; // Clear the file input
//     } else {
//         if (file) {
//             const reader = new FileReader();
//             reader.onload = function(e) {
//                 const previewImage = document.getElementById("imagePreview");
//                 previewImage.src = e.target.result;
//                 previewImage.style.display = "block"; // Show the image
//             };
//             reader.readAsDataURL(file); // Read the file as a data URL
//         }
//     } 
// }

function showImage() {
    const fileInput = document.getElementById("image");
    const file = fileInput.files[0];
    if (file && file.size > 2 * 1024 * 1024) { // 2MB in bytes
        alert('Error: Image file size exceeds 2MB.');
        fileInput.value = ''; // Clear the file input
    } else {
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewPdf = document.getElementById("imagePreview");
                previewPdf.src = e.target.result;
                previewPdf.style.display = "block"; // Show the pdf
            };
            reader.readAsDataURL(file); // Read the file as a data URL
        }
    }
}


function showNewImage() {
    const fileInput = document.getElementById("new-image");
    const file = fileInput.files[0];
    if (file && file.size > 2 * 1024 * 1024) { // 2MB in bytes
        alert('Error: Image file size exceeds 2MB.');
        fileInput.value = ''; // Clear the file input
    } else {
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImage = document.getElementById("imageNewPreview");
                previewImage.src = e.target.result;
                previewImage.style.display = "block"; // Show the image
            };
            reader.readAsDataURL(file); // Read the file as a data URL
        }
    }
}

function pdfPreview() {
    const fileInput = document.getElementById("datasheet");
    const file = fileInput.files[0];
    if (file && file.size > 2 * 1024 * 1024) { // 2MB in bytes
        alert('Error: PDF file size exceeds 2MB.');
        fileInput.value = ''; // Clear the file input
    } else {
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewPdf = document.getElementById("pdfPreview");
                previewPdf.src = e.target.result;
                previewPdf.style.display = "block"; // Show the pdf
            };
            reader.readAsDataURL(file); // Read the file as a data URL
        }
    }
}

function pdfNewPreview() {
    const fileInput = document.getElementById("new-datasheet");
    const file = fileInput.files[0];
    if (file && file.size > 2 * 1024 * 1024) { // 2MB in bytes
        alert('Error: PDF file size exceeds 2MB.');
        fileInput.value = ''; // Clear the file input
    } else {
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewPdf = document.getElementById("pdfNewPreview");
                previewPdf.src = e.target.result;
                previewPdf.style.display = "block"; // Show the pdf
            };
            reader.readAsDataURL(file); // Read the file as a data URL
        }
    }
}
