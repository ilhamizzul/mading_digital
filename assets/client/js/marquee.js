const root = document.documentElement

const marqueeElementDisplayed = getComputedStyle(root).getPropertyValue("--marquee-elements-displayed")
const marqueeContent = document.querySelector(".marquee-content")

root.style.setProperty('--marquee-elements', marqueeContent.children.length)



for (let i = 0; i < marqueeElementDisplayed; i++) {
    marqueeContent.appendChild(marqueeContent.children[i].cloneNode(true))
}

// const root = $(':root')
// const marqueeElementDisplayed = root.css('--marquee-elements-displayed')
// const marqueeContent = $('.marquee-content')

// root.prop('--marquee-elements', $('.marquee-content').children().length)

// root.style.setProperty('--marquee-elements', $('.marquee-content').children().length)