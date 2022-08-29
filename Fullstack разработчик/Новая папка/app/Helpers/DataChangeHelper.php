<?php

  if (!function_exists('declination')) {
    /**
     * @param int    $number - число для определения склонения
     * @param string $value  - существительное для склонения
     * @param array  $suffix - массив суффиксов вида (час)['', 'а', 'ов']
     * @return string - склоненное существительное
     */
    function declination(int $number, string $value, array $suffix, $withValue = false): string
    {
      /* Ключи массива suffix */
      $keys = [2, 0, 1, 1, 1, 2];
      /* Требуются 2 последние цифры */
      $mod = $number % 100;
      /* Определение ключа окончания */
      $suffix_key = $mod > 4 && $mod < 21 ? 2 : $keys[min($mod % 10, 5)];

      return ($withValue ? $number . ' ' : '') . $value . '' . $suffix[$suffix_key];
    }
  }