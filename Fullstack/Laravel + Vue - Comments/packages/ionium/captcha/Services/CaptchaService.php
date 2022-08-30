<?php

  namespace Ionium\Captcha\Services;

  use Illuminate\Support\Facades\Hash;
  use Session;

  class CaptchaService
  {

    /**
     * @var string - строка, содержащая допустимые символы для формирования captcha
     */
    private string $permittedChars;
    /**
     * @var int - число символов в генерируемой строке captcha
     */
    private int $stringLength;
    /**
     * @var string  - строка, содержащая сгенерированную captcha
     */
    private string $captchaString;

    /* Тип шифрования строки captcha в сессии md5 | any[bcrypt laravel]*/
    private string $hashType = 'md5';

    public function __construct()
    {
      $this->config();
    }

    /**
     * @param int    $stringLength   - число символов в генерируемой строке captcha
     * @param string $permittedChars - строка, содержащая допустимые символы для формирования captcha
     * @return $this - после этого метода можно вызвать метод вывода captcha (getCaptcha)
     */
    public function config(int $stringLength = 10, string $permittedChars = '01'): static
    {
      $this->permittedChars = $permittedChars;
      $this->stringLength   = $stringLength;

      $this->captchaString = $this->generateCaptchaString();

      return $this;
    }

    /**
     * Формирует captcha, записывает значение captcha в сессию и возвращает html с изображением captcha
     *
     * @return string
     */
    public function getCaptcha(): string
    {
      $this->setCaptchaKeyInSession();

      return $this->generateCaptchaImageInString();
    }

    /**
     * Устанавливает ключ captcha в сессию
     *
     * @return void
     */
    private function setCaptchaKeyInSession(): void
    {
      if ($this->hashType === 'md5') {
        Session::put('_captchaKey', ['hashType' => 'md5', 'hash' => md5('Captcha_' . $this->captchaString . '_md5')]);
      } else {
        /* Hash::make [~50мс] */
        Session::put('_captchaKey', ['hashType' => 'bcrypt', 'hash' => Hash::make($this->captchaString)]);
      }
    }

    /**
     * Генерирует случайную строку определенной длины $stringLength из символов, содержащихся в строке $permittedChars
     *
     * @return string         - сгенерированная строка captcha
     */
    private function generateCaptchaString(): string
    {
      $permittedCharsCount = strlen($this->permittedChars);
      $captchaString       = '';
      for ($i = 0; $i < $this->stringLength; $i++) {
        $captchaString .= $this->permittedChars[mt_rand(0, $permittedCharsCount - 1)];
      }

      return $captchaString;
    }

    /**
     * Генерирует изображение captcha, возвращает результат в формате string (html)
     *
     * @return string -  изображение captcha
     */
    private function generateCaptchaImageInString(): string
    {
      $result = '<div class="captcha__wrapper demo">';

      for ($i = 0; $i < $this->stringLength; $i++) {
        if ($this->captchaString[$i] === '1') {
          $result .= '<div class="captcha__element"><div class="captcha__element-label"><span class="captcha__element-content demo active"><span class="site-icon dark"></span></span></div></div>';
        } else {
          $result .= '<div class="captcha__element"><div class="captcha__element-label"><span class="captcha__element-content demo"><span class="site-icon dark"></span></span></div></div>';
        }
      }
      $result .= '</div>';
      return $result;
    }
  }
