function parseTimeOfDay(date) {
    return `${date.getHours().toString().padStart(2, "0")}:${date.getMinutes().toString().padStart(2, "0")}:${date.getSeconds().toString().padStart(2, "0")}`;
}

function parseDate(date) {
    return `${date.getDate()}.${date.getMonth()+1}. ${date.getFullYear()}`
}

function parseFullDate(date) {
    return parseTimeOfDay(date) + " " + parseDate(date);
}