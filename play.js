const audioElement = new Audio("song.MP3")
const playTimeEl = document.querySelector('#playTime')
const playProgressEl = document.querySelector('#playProgress')
const playPrevButtonEl = document.querySelector('#playPrev')
const playButtonEl = document.querySelector('#play')
const playNextButtonEl = document.querySelector('#playNext')
const repeatButtonEl = document.querySelector('#repeat')
const minimise = document.querySelector('#minimise')

let playing = false
let repeat = false

audioElement.ontimeupdate = () => {
    let mins = Math.floor(audioElement.currentTime / 60)
    let seconds = parseInt(audioElement.currentTime % 60)
    if (seconds < 10) {
        seconds = '0' + seconds
    }
    playTimeEl.textContent = mins.toString() + ':' + seconds.toString()
    playProgressEl.style.width = ((audioElement.currentTime / audioElement.duration) * 100) + '%'
}

audioElement.onended = () => {
    playing = false
    if (repeat) {
        play()
    }
}

const togglePlay = () => {
    if (playing) {
        pause()
    } else {
        play()
    }
}

const play = () => {
    audioElement.play()
    playing = true
    playButtonEl.classList.add('text-orange-500')
}

const pause = () => {
    audioElement.pause()
    playing = false
    playButtonEl.classList.remove('text-orange-500')
}

const restart = () => {
    audioElement.currentTime = 0
}

const restartAndPlay = () => {
    restart()
    play()
}

const toggleRepeat = () => {
    repeat = !repeat
    repeatButtonEl.classList.toggle('text-orange-500')
}

const skip = () => {
    audioElement.currentTime = 200
}

playButtonEl.addEventListener('click', togglePlay)
playPrevButtonEl.addEventListener('click', restart)
playNextButtonEl.addEventListener('click', restart)
repeatButtonEl.addEventListener('click', toggleRepeat)

const urlParams = new URLSearchParams(window.location.search);
if (urlParams.get('playSong')) {
    if (navigator.getAutoplayPolicy("audiocontext") === 'allowed') {
        restartAndPlay()
    } else {
        alert('Autoplay disabled, please change your browser settings and refresh the page')
    }
}

minimise.addEventListener('click', () => {
    minimise.classList.toggle('open')
    document.querySelector('main').classList.toggle('minimised')
})