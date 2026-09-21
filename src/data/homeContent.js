export const HOMEPAGE_IMAGE = "/assets/imgs/feboking-home.png";

export const heroShots = [
  {
    label: "view ban công ngắm hoàng hôn",
    src: HOMEPAGE_IMAGE
  },
  {
    label: "góc chill trong phòng",
    src: HOMEPAGE_IMAGE
  },
  {
    label: "máy chiếu full HD",
    src: HOMEPAGE_IMAGE
  },
  {
    label: "phòng ngủ cinema",
    src: HOMEPAGE_IMAGE
  },
  {
    label: "thỏa sức chill cùng boardgames",
    src: HOMEPAGE_IMAGE
  }
];

export const experienceMoods = [
  {
    title: "Buổi chiếu riêng",
    text: "Máy chiếu · Netflix · Sofa êm",
    image: HOMEPAGE_IMAGE
  },
  {
    title: "Ngâm mình thư giãn",
    text: "Bồn tắm · Ánh đèn dịu · Nghỉ ngơi",
    image: HOMEPAGE_IMAGE
  },
  {
    title: "Hẹn hò vui vẻ",
    text: "Boardgame · Đồ ăn nhẹ · Tiếng cười",
    image: HOMEPAGE_IMAGE
  },
  {
    title: "Bữa tối tại phòng",
    text: "Bếp riêng · Bàn ăn · Ấm cúng",
    image: HOMEPAGE_IMAGE
  },
  {
    title: "Ở lại thật lâu",
    text: "Giường lớn · Không gian yên tĩnh",
    image: HOMEPAGE_IMAGE
  }
];

export const experienceSteps = [
  {
    time: "18:00",
    title: "Đến nơi nhẹ nhàng",
    text: "Nhận hướng dẫn rõ ràng trước giờ hẹn.",
    image: HOMEPAGE_IMAGE,
    icon: "key"
  },
  {
    time: "18:15",
    title: "Chọn mood cho buổi hẹn",
    text: "Bật playlist, chuẩn bị đồ ăn và thảnh thơi.",
    image: HOMEPAGE_IMAGE,
    icon: "sofa"
  },
  {
    time: "19:30",
    title: "Khoảnh khắc của hai người",
    text: "Tận hưởng màn chiếu lớn và không gian riêng tư.",
    image: HOMEPAGE_IMAGE,
    icon: "movie"
  },
  {
    time: "22:00",
    title: "Không cần vội vàng",
    text: "Chọn qua đêm khi bạn muốn thời gian dài hơn.",
    image: HOMEPAGE_IMAGE,
    icon: "moon"
  }
];

export const branchHighlights = [
  {
    name: "Biên Hòa",
    text: "12+ phòng · Cách trung tâm 5 phút",
    image: HOMEPAGE_IMAGE
  },
  {
    name: "Dĩ An",
    text: "8+ phòng · Cách trung tâm 10 phút",
    image: HOMEPAGE_IMAGE
  },
  {
    name: "Thủ Đức",
    text: "6+ phòng · Cách trung tâm 15 phút",
    image: HOMEPAGE_IMAGE
  }
];

export const featureList = [
  "Nội thất hiện đại, đầy đủ tiện ích",
  "Máy chiếu + Netflix FREE, chill hết đêm",
  "Bếp nấu riêng, nấu ăn thoải mái như ở nhà",
  "Máy giặt & sấy tiện lợi cho kỳ nghỉ dài ngày",
  "Không gian sạch sẽ, ấm cúng",
  "Vị trí thuận tiện, dễ dàng di chuyển đến TP.HCM"
];

export const bookingSlots = [
  { id: "morning", label: "8:00 - 11:00", type: "three_hours", rateName: "Theo 3 tiếng", start: "08:00", end: "11:00", crossesMidnight: false, price: 200000 },
  { id: "noon", label: "11:30 - 14:30", type: "three_hours", rateName: "Theo 3 tiếng", start: "11:30", end: "14:30", crossesMidnight: false, price: 200000 },
  { id: "afternoon", label: "15:00 - 18:00", type: "three_hours", rateName: "Theo 3 tiếng", start: "15:00", end: "18:00", crossesMidnight: false, price: 200000 },
  { id: "overnight", label: "18:30 - 07:20", subLabel: "(Qua đêm)", type: "overnight", rateName: "Qua đêm", start: "18:30", end: "07:20", crossesMidnight: true, price: 370000 },
  { id: "full_day", label: "08:00 - 22:00", type: "full_day", rateName: "Cả ngày", start: "08:00", end: "22:00", crossesMidnight: false, price: 580000 }
];
