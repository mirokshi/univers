export default ms => new Promise((resolve, reject) => {
  setTimeout(() => {
    resolve();
  }, ms);
});
