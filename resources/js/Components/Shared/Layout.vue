<script>
import flasher from "@flasher/flasher";

export default {
  props: {
    message: Object,
  },
  watch: {
    messages(value) {
      flasher.render(value);
    }
  }
}
</script>
