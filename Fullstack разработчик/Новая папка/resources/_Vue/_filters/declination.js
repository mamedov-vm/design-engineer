export default {
  declination(number, value, suffix, withValue = false) {
    let keys = [2, 0, 1, 1, 1, 2];
    let mod = number % 100;
    let suffix_key = (
                         mod > 4 && mod < 21
                     ) ? 2
                       : keys[
                         Math.min(
                             mod % 10,
                             5,
                         )
                         ];

    return `${ withValue ? (number + ' ') : '' }${ value }${ suffix[suffix_key] }`;
  },
}