<template>
    <div class="notification-message">
        <span class="user">
            <span class="user__avatar-wrp">
                <img class="user__avatar" :src="getUserAvatar">
            </span>
            <router-link
                class="user__name"
                :to="{ name: 'OtherUserPage', params: { id: user.id } }"
            >
                {{ getUserName }}
            </router-link>
        </span>
        <span class="text">{{ $t('notifications.followed_user_delete_list.delete') }}</span>
        <span>{{ this.notification }}</span>
        <span class="date" v-if="createdAt">
            ({{ getDate }})
        </span>
    </div>
</template>

<script>
import notificationsMixin from '@/components/mixins/notifications';

export default {
    name: 'FollowedUserDeleteListNotification',
    mixins: [notificationsMixin]
};
</script>

<style lang="scss" scoped>
    @import '@/styles/notifications.scss';
</style>