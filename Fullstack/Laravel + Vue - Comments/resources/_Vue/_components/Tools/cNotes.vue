<template>
	<div class="notifications">
		<TransitionGroup
				name="notification-slide"
				tag="div"
		>
			<div
					v-for="notification in notifications"
					:key="notification.key"
			>
				<div
						class="notification"
				>
					<div
							class="notification__icon"
							:class="'type' + notification.type"
					>
						<i :class="getIcon(notification.type)"></i>
					</div>
					<div
							class="notification__message"
					>
						<div
								class="notification__message-title"
								v-html="notification.title"
						></div>
						<div
								class="notification__message-content"
								v-html="notification.content"
								v-if="notification.content !== ''"
						></div>
					</div>
					<div
							class="notification__close-btn"
					>
						<i
								@click="close(notification)"
								@keydown.enter.space="close(notification)"

								class="far fa-times"
								aria-hidden="true"
								role="button"
								title="Закрыть уведомление"
								tabindex="0"
						></i>
					</div>
				</div>
			</div>
		</TransitionGroup>
	</div>
</template>

<script>
export default {
	name: 'cNotes',
	props: {
		notificationsCount: {
			type: Number,
			default: 5,
		},
		showTime: {
			type: Number,
			default: 7000,
		},
	},
	data() {
		return {
			notifications: [],
		}
	},
	methods: {
		new: function (content, type = 1) {
			if (this.notifications.length >= this.notificationsCount) {
				this.notifications.length = 0;
			}
			let notifications = content.split('|');
			let newNotification = {
				title: notifications[0],
				content: notifications[1] ?? '',
				type: type,
				key: Date.now(),
			};
			this.notifications.push(newNotification);
			setTimeout(
					() => {
						this.close(newNotification);
					},
					this.showTime,
			);
		},
		getIcon: function (type) {
			switch (type) {
				case 'green':
				case 'g':
				case 1: {
					return 'fal fa-check-circle'
				}
				case 'yellow':
				case 'y':
				case 2: {
					return 'fal fa-exclamation-circle'
				}
				case 'red':
				case 'r':
				case 3: {
					return 'fal fa-times-circle'
				}
				default: {
					return 'fal fa-check-circle'
				}
			}
		},
		close: function (newNotification) {
			this.notifications = this.notifications.filter(notification => newNotification.key !== notification.key);
		},
	},
	created() {
		window.app.newNoty = this.new;

		let serverNotification = document.querySelector('meta[name="app:notification"]').getAttribute('content');
		let serverNotificationType = document.querySelector('meta[name="app:notificationType"]').getAttribute('content');

		if (serverNotification && serverNotification !== '') {
			setTimeout(() => window.app.newNoty(serverNotification, parseInt(serverNotificationType) ?? 2), 300);
		}
	},
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.notification-slide-enter-active,
.notification-slide-leave-active {
	transition: all 0.5s ease;
}

.notification-slide-enter-from,
.notification-slide-leave-to {
	opacity: 0;
	transform: translateX(-30px);
}

.notifications {
	display: flex;
	flex-direction: column;

	position: fixed;
	bottom: 10px;
	left: 15px;

	width: 460px;

	z-index: 999;
}

.notification {
	display: flex;

	color: $gr_05;

	border-radius: 12px;
	background: $gr_90;
	transition: .3s;

	margin-top: 20px;
	padding: 16px 6px 16px 12px;

	&__close-btn {
		display: flex;
		justify-content: center;
		align-items: center;

		margin-left: 8px;

		& i {
			display: block;
			width: 30px;
			height: 30px;

			font-size: 20px;
			color: $w;
			text-align: center;
			line-height: 30px;

			cursor: pointer;
			border-radius: 50%;
			transition: color .3s;
		}

		& i:hover {
			color: $gr_40;
		}

		& i:focus-visible {
			outline: $c_90 2px solid;
		}
	}

	&__icon {
		display: flex;
		justify-content: center;
		align-items: center;


		font-size: 42px;

		margin-right: 12px;

		&.type1 {
			color: $g_60;
		}

		&.type2 {
			color: $o_60;
		}

		&.type3 {
			color: #ff2c2c;
		}

		& i {
			display: block;
		}
	}

	&__message {
		width: 100%;

		&-title {
			line-height: 24px;
			font-size: 18px;
			font-weight: 500;
		}

		&-content {
			color: $gr_30;
			line-height: 1.4rem;

			padding-top: 6px;
		}

	}
}
</style>