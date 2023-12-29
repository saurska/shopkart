// resources/js/Components/Footer.jsx
import React from 'react';
import { Link } from '@inertiajs/react';

const Footer = () => {
  return (
    <footer className="bg-gray-800 text-white p-8">
      <div className="container mx-auto flex flex-col lg:flex-row items-center justify-between">
        <div className="mb-4 lg:mb-0">
          <h2 className="text-2xl font-bold">ShopKart</h2>
          <p className="text-gray-400">Your one-stop shop for everything!</p>
        </div>
        <div className="flex space-x-4">
          <div>
            <h3 className="text-xl font-semibold mb-2">Quick Links</h3>
            <ul className="list-none p-0 m-0">
              <li>
                <Link href="/">Home</Link>
              </li>
              <li>
                <Link href="/products">Products</Link>
              </li>
              <li>
                <Link href="/cart">Cart</Link>
              </li>
            </ul>
          </div>
          <div>
            <h3 className="text-xl font-semibold mb-2">Account</h3>
            <ul className="list-none p-0 m-0">
              <li>
                <Link href={route('login')}>Log in</Link>
              </li>
              <li>
                <Link href={route('register')}>Register</Link>
              </li>
              {/* <li>
                <Link href={route('become-seller')}>Become a Seller</Link>
              </li> */}
            </ul>
          </div>
          <div>
            <h3 className="text-xl font-semibold mb-2">Categories</h3>
            {/* Add your product categories here as links */}
            <ul className="list-none p-0 m-0">
              <li>
                <Link href="/category/electronics">Electronics</Link>
              </li>
              <li>
                <Link href="/category/clothing">Clothing</Link>
              </li>
              {/* Add more categories as needed */}
            </ul>
          </div>
        </div>
        <div className="mt-8 lg:mt-0">
          <h3 className="text-xl font-semibold mb-2">Contact Us</h3>
          <p>Email: info@shopkart.com</p>
          <p>Phone: +123 456 7890</p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
