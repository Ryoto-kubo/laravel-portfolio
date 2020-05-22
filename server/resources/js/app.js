import './bootstrap'
import './multiple'
import Vue from 'vue'
import FollowButton from './components/FollowButton'
import PostTagsInput from './components/PostTagsInput'

const app = new Vue({
  el: '#app',
  components: {
    FollowButton,
    PostTagsInput,
  }
})