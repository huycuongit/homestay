export const heroShots = [
  {
    label: "view ban công ngắm hoàng hôn",
    src: "https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=500&q=80"
  },
  {
    label: "góc chill trong phòng",
    src: "https://images.unsplash.com/photo-1616046229478-9901c5536a45?auto=format&fit=crop&w=500&q=80"
  },
  {
    label: "máy chiếu full HD",
    src: "https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?auto=format&fit=crop&w=500&q=80"
  },
  {
    label: "phòng ngủ cinema",
    src: "https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=500&q=80"
  },
  {
    label: "thỏa sức chill cùng boardgames",
    src: "https://images.unsplash.com/photo-1610890716171-6b1bb98ffd09?auto=format&fit=crop&w=500&q=80"
  }
];

export const experienceMoods = [
  {
    title: "Movie Night",
    text: "Máy chiếu · Netflix · Sofa",
    image: "https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?auto=format&fit=crop&w=600&q=85"
  },
  {
    title: "Bath & Chill",
    text: "Bồn tắm · Nến thơm · Thư giãn",
    image: "https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=600&q=85"
  },
  {
    title: "Game Date",
    text: "PS5 · Boardgame · Giải trí",
    image: "https://images.unsplash.com/photo-1605901309584-818e25960a8f?auto=format&fit=crop&w=600&q=85"
  },
  {
    title: "Cook Together",
    text: "Bếp riêng · Bàn ăn · Ấm cúng",
    image: "https://images.unsplash.com/photo-1556911220-bff31c812dba?auto=format&fit=crop&w=600&q=85"
  },
  {
    title: "Overnight",
    text: "Giường lớn · Check-out muộn",
    image: "https://images.unsplash.com/photo-1616594039964-ae9021a400a0?auto=format&fit=crop&w=600&q=85"
  }
];

export const experienceSteps = [
  {
    time: "18:00",
    title: "Check-in nhanh",
    text: "Nhận phòng dễ dàng, không cần chờ đợi.",
    image: "https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=600&q=85",
    icon: "key"
  },
  {
    time: "18:15",
    title: "Chill một chút",
    text: "Bật playlist, gọi đồ ăn, ngả lưng trên sofa.",
    image: "https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=600&q=85",
    icon: "sofa"
  },
  {
    time: "19:30",
    title: "Movie Night",
    text: "Netflix + máy chiếu, chọn một bộ phim cả hai thích.",
    image: "https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?auto=format&fit=crop&w=600&q=85",
    icon: "movie"
  },
  {
    time: "22:00",
    title: "Chẳng cần vội",
    text: "Muốn ở thêm? Gia hạn ngay trên ftft.",
    image: "https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=600&q=85",
    icon: "moon"
  }
];

export const branchHighlights = [
  {
    name: "Biên Hòa",
    text: "12+ phòng · Cách trung tâm 5 phút",
    image: "https://images.unsplash.com/photo-1600585154363-67eb9e2e2099?auto=format&fit=crop&w=500&q=85"
  },
  {
    name: "Dĩ An",
    text: "8+ phòng · Cách trung tâm 10 phút",
    image: "https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=500&q=85"
  },
  {
    name: "Thủ Đức",
    text: "6+ phòng · Cách trung tâm 15 phút",
    image: "https://images.unsplash.com/photo-1616046229478-9901c5536a45?auto=format&fit=crop&w=500&q=85"
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
