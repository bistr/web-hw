function calculate_sign(e) {
    let zodiacName = ["Овен", "Телец", "Близнаци", "Рак", "Лъв", "Дева", "Везни", "Скорпион", "Стрелец", "Козирог", "Водолей", "Риби"];
    let firstDayInMonth = {};
    firstDayInMonth[1] = 20;
    firstDayInMonth[2] = 20;
    firstDayInMonth[3] = 21;
    firstDayInMonth[4] = 21;
    firstDayInMonth[5] = 22;
    firstDayInMonth[6] = 22;
    firstDayInMonth[7] = 23;
    firstDayInMonth[8] = 24;
    firstDayInMonth[9] = 24;
    firstDayInMonth[10] = 23;
    firstDayInMonth[11] = 23;
    firstDayInMonth[12] = 22;

    let date = e.target.value;
    let parts = date.split("-")
    let month = parseInt(parts[1]);
    let day = parseInt(parts[2]);
    let zodiacNumber = (month + 9) % 12;

    if (firstDayInMonth[month] > day) {
        zodiacNumber -= 1;
        if (zodiacNumber < 0) {
            zodiacNumber = 11;
        }
    }
    document.getElementById("zodiac_sign").value = zodiacName[zodiacNumber];
    document.getElementById("zodiac_sign").textContent = zodiacName[zodiacNumber];
}