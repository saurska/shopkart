// resources/js/Components/MainMenu.jsx
import React from 'react';
import { Link } from '@inertiajs/react';

const MainMenu = () => {
  const categories = [
    { id: 1, name: 'Mobiles', slug: 'mobiles', image: '/images/mobiles.jpg' },
    { id: 2, name: 'Electronics', slug: 'electronics', image: '/images/electronics.jpg' },
    { id: 3, name: 'Fashion', slug: 'fashion', image: '/images/fashion.jpg' },
    { id: 4, name: 'Beauty & Personal Care', slug: 'beauty-personal-care', image: '/images/beauty.jpg' },
    { id: 5, name: 'Home & Living', slug: 'home-living', image: '/images/home-living.jpg' },
    { id: 6, name: 'Sports & Outdoors', slug: 'sports-outdoors', image: '/images/sports-outdoors.jpg' },
    // Add more categories as needed
  ];

  return (
    <div className="bg-gray-700 text-white py-4 text-center">
      <ul className="flex justify-center space-x-6">
        {categories.map((category) => (
          <li key={category.id}>
            <Link
              href={`/category/${category.slug}`}
              className="hover:text-gray-300 transition duration-300"
            >
              <div className="flex flex-col items-center">
                <img
                  src={category.image}
                  alt={category.name}
                  className="mb-2 w-16 h-16 object-cover rounded-full border border-white"
                />
                <span className="text-sm">{category.name}</span>
              </div>
            </Link>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default MainMenu;
