import axiosInstance from "./axiosInstance";

export const autocompleteTown = (search, onlyEnabled) =>
  axiosInstance.get(
    `/geo/towns/autocomplete?search=${search}&onlyEnabled=${onlyEnabled.toString()}`
  );

export const getAirports = async () => {
  return await axiosInstance.get(`/airports`);
};

export const getLowestPrice = async (departureAirportCode, arrivalAirportCode) => {
  return await axiosInstance.post(`/flights`, {departureAirportCode, arrivalAirportCode});
};

export default {
  getAirports,
  getLowestPrice,
};
