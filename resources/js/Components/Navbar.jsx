// resources/js/Components/Navbar.jsx
import React from 'react';
import { Link } from '@inertiajs/react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faSearch, faShoppingCart, faUser } from '@fortawesome/free-solid-svg-icons';

const Navbar = ({ auth }) => {
  return (
    <div className="bg-gray-800 p-4 text-white flex flex-col lg:flex-row justify-between items-center">
      <div className="flex items-center mb-4 lg:mb-0">
        <Link href="/" className="text-3xl font-bold flex items-center">
          <FontAwesomeIcon icon={faShoppingCart} className="text-blue-500 mr-2" />
          ShopKart
        </Link>
      </div>
      <div className="flex-grow lg:mx-10">
        <div className="relative">
          <input
            type="text"
            placeholder="Search products..."
            className="p-3 pl-10 pr-4 border rounded-full bg-gray-700 text-gray-300 focus:outline-none focus:border-blue-500 w-full"
          />
          <FontAwesomeIcon icon={faSearch} className="absolute left-4 top-3 text-gray-500" />
        </div>
      </div>
      <div className="flex flex-col lg:flex-row items-center space-y-4 lg:space-y-0 lg:space-x-4">
        <Link href="/cart" className="hover:text-gray-300 flex items-center">
          <FontAwesomeIcon icon={faShoppingCart} className="text-xl mr-1" />
          Cart
        </Link>
        {auth.user ? (
          <Link href={route('dashboard')} className="hover:text-gray-300 flex items-center">
            <FontAwesomeIcon icon={faUser} className="text-xl mr-1" />
            Account
          </Link>
        ) : (
          <>
            <Link href={route('login')} className="hover:text-gray-300">
              Log in
            </Link>
            <Link href={route('register')} className="hover:text-gray-300">
              Register
            </Link>
          </>
        )}
      </div>
    </div>
  );
};

export default Navbar;
