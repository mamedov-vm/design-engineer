export default {
  date(date, template) {
    let dateObject = new Date(date);
    let result = template;

    let parts = {
      d: dateObject.getDate() < 10 ? '0' + dateObject.getDate() : dateObject.getDate(),
      m: dateObject.getMonth() + 1 < 10 ? '0' + (dateObject.getMonth() + 1) : dateObject.getMonth() + 1,
      y: dateObject.getFullYear(),
      h: dateObject.getHours(),
      i: dateObject.getMinutes() < 10 ? '0' + dateObject.getMinutes() : dateObject.getMinutes(),
      s: dateObject.getSeconds() < 10 ? '0' + dateObject.getSeconds() : dateObject.getSeconds(),
    }

    for (let part in parts) {
      result = result.replace(
          new RegExp(
              part,
              'g',
          ),
          parts[part],
      );
    }

    return result;
  },
}