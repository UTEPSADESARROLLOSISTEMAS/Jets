let uploadButton = document.getElementById("foto");
    let chosenImage = document.getElementById("image_c");

    let uploadButton1 = document.getElementById("foto1");
    let chosenImage1 = document.getElementById("image_c1");

    function cambiarImagen(button, chosen) {
      button.onchange = () => {
        let reader = new FileReader();
        reader.readAsDataURL(button.files[0]);
        reader.onload = () => {
          chosen.setAttribute("src", reader.result);
        }
      }
    }

    cambiarImagen(uploadButton, chosenImage);
    cambiarImagen(uploadButton1, chosenImage1);