export const formatPrice = (price: number | string) => {
  return price
    .toString()
    .replace(/\./g, ".")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};
