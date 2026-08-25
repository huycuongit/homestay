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
