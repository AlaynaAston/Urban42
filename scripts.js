const buttons = document.querySelectorAll("[data-carousel-button]");
const buttonsArray = Array.from(buttons);
//this basically checks when a button is clicked
//if the data assigned to the button is next, it should return 1 (i used shorthand here)
//else it should return -1.


buttonsArray.forEach(button => {
    button.addEventListener("click", () => {
        console.log("button was clicked!")
        const offset = button.dataset.carouselButton === "next" ? 1 : -1
        //this line ensures that if we have multiple slides, the button clicked should work for the
        //carousel that it is tied to. 
        const slides = button
        .closest("[data-carousel]")
        .querySelector("[data-slides]")


        const activeSlide = slides.querySelector("[data-active]")
        let newIndex = [...slides.children].indexOf(activeSlide) + offset
        //for being able Sto loop through slides without an OutOfBounds error
        if(newIndex < 0) newIndex = slides.children.length - 1
        if (newIndex >= slides.children.length) newIndex = 0

        slides.children[newIndex].dataset.active = true
        delete activeSlide.dataset.active
    })
});