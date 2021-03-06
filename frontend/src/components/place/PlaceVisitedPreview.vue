<template>
    <transition name="slide-fade">
        <div class="container place-item" v-if="active">
            <div class="media">
                <figure v-if="hasPhotos" class="media-left image is-96x96">
                    <img 
                        v-for="(photo, index) in place.photos"
                        v-img="{group: place.id}"
                        v-show="index === 0"
                        :src="photo.img_url"
                        :key="photo.id"
                    >
                </figure>
                <figure v-else class="media-left image is-96x96">
                    <img :src="notFoundPhoto">
                </figure>
                <div class="media-content">
                    <p class="address">
                        {{ $t('check-ins_page.visited_at') }}
                        {{ date }}
                    </p>
                    <h3
                        class="title has-text-primary"
                    >
                        <router-link :to="`/places/${place.id}`">
                            {{ localizedName }}
                        </router-link>

                    </h3>
                    <p class="address">
                        <strong>{{ place.city.name }}</strong>, {{ place.address }}
                    </p>
                </div>
                <div class="media-right rating-wrapper">
                    <PlaceRating
                        v-if="place.rating"
                        :value="Number(place.rating)"
                    />
                </div>
            </div>
        </div>
    </transition>
</template>

<style lang="scss" scoped>
    .place-item {
        background: #FFF;
        color: grey;
        max-width: 100%;
        margin-bottom: 1rem;
        padding: 10px;
    }

    .columns {
        width: 100%;
        margin: 0;
    }

    .title {
        margin-bottom: 0.5rem;
        font-size: 1.3rem;
    }

    .image > img {
        border-radius: 5px;
    }

    .place-category {
        margin-bottom: 0.25rem;
        a {
            color: grey;
            -webkit-transition: color 0.3s;
            -moz-transition: color 0.3s;
            -ms-transition: color 0.3s;
            -o-transition: color 0.3s;
            transition: color 0.3s;

            &:hover {
                color: black;
                text-decoration: underline;
            }
        }
    }

    .address {
        margin-bottom: 0.5rem;
    }

    hr {
        color: grey;
        border-width: 3px;
    }

    .slide-fade-enter-active {
        transition: all 0.5s ease;
    }

    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateX(300px);
        opacity: 0;
    }

</style>

<script>
import Review from '@/components/review/PlacePreviewReviewItem';
import imagePlaceholder from '@/assets/placeholder_128x128.png';
import PlaceRating from './PlaceRating';
import moment from 'moment';

export default {
    name: 'PlaceVisitedPreview',
    components: {
        Review,
        PlaceRating,
    },
    data() {
        return {
            active: false
        };
    },
    filters: {
        timeDate: function(dateTime){
            return moment.utc(dateTime).local().format('MMMM DD, HH:mm');
        },
    },
    props: {
        place: {
            required: true,
            type: Object,
        },
        checkin: {
            required: true,
            type: Object,
        },
        timer: {
            required: true,
            type: Number,
        }
    },
    computed: {
        localizedName(){
            return this.place.localization[0].name;
        },
        hasPhotos() {
            return this.place.photos !== undefined && this.place.photos.length;
        },
        notFoundPhoto() {
            return imagePlaceholder;
        },
        date() {
            const date = new Date(this.checkin.createdAt);
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                weekday: 'long'
            };
            
            let locale = this.$i18n.locale();
            if (locale === 'ua') {
                locale = 'uk';
            }

            return date.toLocaleString(locale, options);
        }
    },
    methods: {
        like() {
            this.$toast.open({
                message: this.$t('place_page.message.review_like'),
                type: 'is-info',
                position: 'is-bottom'
            });
        },
        dislike() {
            this.$toast.open({
                message: this.$t('place_page.message.review_dislike'),
                position: 'is-bottom',
                type: 'is-info'
            });
        }
    },
    created() {
        setTimeout(() => {
            this.active = true;
        }, this.timer);
    }
};
</script>
