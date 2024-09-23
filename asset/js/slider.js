document.addEventListener("DOMContentLoaded", function () {
    // Carousel slider
    var items = document.querySelectorAll('.carousel .carousel-item');
    items.forEach((el) => {
      const minPerSlide = 3;
      let next = el.nextElementSibling;
      for (var i = 1; i < minPerSlide; i++) {
        if (!next) {
          // wrap carousel by using first child
          next = items[0];
        }
        let cloneChild = next.cloneNode(true);
        el.appendChild(cloneChild.children[0]);
        next = next.nextElementSibling;
      }
    });
  
    // Image click event to display modal
    var images = document.querySelectorAll(".carousel-item img");
    images.forEach(function (image) {
      image.addEventListener("click", function () {
        var imageURL = image.getAttribute("src");
        // Create a new image element
        var popupImage = document.createElement("img");
        popupImage.setAttribute("src", imageURL);
        popupImage.setAttribute("class", "img-fluid");
  
        // Create a modal to display the image
        var modal = document.createElement("div");
        modal.setAttribute("class", "modal");
        modal.appendChild(popupImage);
  
        // Add modal to the body
        document.body.appendChild(modal);
  
        // Close modal when clicked outside the image
        modal.addEventListener("click", function () {
          document.body.removeChild(modal);
        });
      });
    });
  });
  