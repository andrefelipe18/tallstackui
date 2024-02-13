export default (number, duration) => ({
  visible: false,
  start: 0,
  number: number,
  duration: duration,
  init() {
    this.$watch('visible', () => {
      const $el = this.$refs.number;
      const step = (timestamp) => {
        if (!this.start) this.start = timestamp;
        const progress = timestamp - this.start;
        const percentage = Math.min(progress / (this.duration * 1000), 1);
        const value = Math.floor(percentage * this.number);
        $el.innerHTML = value.toLocaleString();
        if (progress < (this.duration * 1000)) {
          window.requestAnimationFrame(step);
        }
      };
      window.requestAnimationFrame(step);
    });
  },
});
