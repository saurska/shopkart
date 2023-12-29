// resources/js/Components/ImageSlider.jsx
import React from 'react';
import Slider from 'react-slick';

import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';

const ImageSlider = ({ imageUrls }) => {
  // Customize settings as per your requirement
  const sliderSettings = {
    dots: true,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
  };

  const slides = [
    { id: 1, image: 'url_to_your_image_1.jpg', alt: 'Image 1' },
    { id: 2, image: 'url_to_your_image_2.jpg', alt: 'Image 2' },
    // Add more slides as needed
  ];

  return (
    <div className="w-full overflow-hidden">
    <Slider {...sliderSettings}>
      {imageUrls.map((imageUrl, index) => (
        <div key={index}>
          <img src={imageUrl} alt={`Image ${index + 1}`} className="w-full h-auto" />
        </div>
      ))}
    </Slider>
    </div>
  );
};

export default ImageSlider;
