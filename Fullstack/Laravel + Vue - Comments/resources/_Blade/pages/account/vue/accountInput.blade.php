@verbatim
	 <!--suppress HtmlUnknownAttribute -->
	 <!--suppress HtmlFormInputWithoutLabel -->
	 <template id="accountInput">
			<div
			 class="auth__form-input"
			 :class="{'focus': isInputFocus}"
			>
				 <label :for="'auth__' + name">
						{{ label }}
						<transition
						 name="flip"
						 mode="out-in"
						>
							 <svg
								class="auth__form-validator"
								:class="{'valid': modelValue.valid}"
								width="12px"
								height="10px"
								viewBox="0 0 14 12"
							 >
									<path d="M1 7 5.5 11 L13 1"></path>
							 </svg>
						</transition>
				 </label>
				 <i
					:class="icon"
					v-tooltip="{tip: tip, dir: 'r'}"
					aria-hidden="true"
				 ></i>
				 <input
					:type="type"
					:name="name"
					:id="'auth__' + name"
					:title="hint"
					
					:value="modelValue.value"
					@input="updateControl"
					@focus="focusController('focus')"
					@blur="focusController('blur')"
					ref="inputControl"
					
					autocomplete="off"
					spellcheck="false"
				 >
				 <i
					v-if="type === 'password'"
					class="fa fa-eye"
					title="Подсмотреть пароль"
					role="button"
					aria-label="Подсмотреть пароль"
					@click="showInput"
					ref="passwordShowIcon"
				 ></i>
			</div>
	 </template>
@endverbatim

<script type="module">
  (
      function () {
        window.app.component(
            'accountInput',
            {
              template: document.querySelector('#accountInput').innerHTML,
              props: {
                modelValue: {
                  type: Object,
                  default: {
                    valid: false,
                    value: '',
                  },
                },
                name: {
                  type: String,
                  required: true,
                },
                type: {
                  type: String,
                  required: true,
                },
                label: {
                  type: String,
                  required: true,
                },
                icon: {
                  type: String,
                  required: true,
                },
                hint: {
                  type: String,
                  default: '',
                },
                tip: {
                  type: String,
                  required: true,
                },
                tipDir: {
                  type: String,
                  default: 'r',
                },
                pattern: {
                  type: String,
                  default: null,
                },
              },
              data() {
                return {
                  isInputFocus: false,
                  inputType: this.type,
                  regExp: (
                              this.pattern && this.pattern !== ''
                          ) ?
                          new RegExp(
                              '^' + this.pattern + '$',
                              '',
                          )
                            : null,
                }
              },
              mounted() {
                if (this.modelValue.value !== '') {
                  this.isInputFocus = true;
                }
              },
              methods: {
                updateControl: function (event) {
                  this.$emit(
                      'update:modelValue',
                      {
                        value: event.target.value,
                        valid: this.regExp.test(event.target.value.toString()),
                      },
                  );
                },
                focusController(event) {
                  switch (event) {
                    case 'focus':
                      this.isInputFocus = true;
                      break;
                    case 'blur':
                      if (this.modelValue.value === '') {
                        this.isInputFocus = false;
                      }
                      break;
                  }
                },
                showInput() {
                  if (this.inputType === 'password' && this.modelValue.value !== '') {
                    this.$refs.inputControl.setAttribute(
                        'type',
                        'text',
                    );
                    this.$refs.passwordShowIcon.classList.toggle('fa-eye-slash');
                    this.inputType = 'text';
                  } else if (this.modelValue.value !== '') {
                    this.$refs.inputControl.setAttribute(
                        'type',
                        'password',
                    );
                    this.$refs.passwordShowIcon.classList.toggle('fa-eye-slash');
                    this.inputType = 'password';
                  }
                },
              },
            },
        );
      }()
  );
</script>