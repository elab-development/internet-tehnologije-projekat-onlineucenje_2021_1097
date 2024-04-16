import React from 'react';

import { blog } from '../../dummydata';
import './footer.css';

const Footer = () => {
  return (
    <>
      <section className='newletter'>
        <div className='container flexSB'>
          <div className='left row'>
            <h1>Newsletter - Stay tuned and get the latest updates</h1>
            <span>
              Lorem ipsum dolor, sit amet consectetur adipisicing elit.
            </span>
          </div>
          <div className='right row'>
            <input type='text' placeholder='Enter email address' />
            <i className='fa fa-paper-plane'></i>
          </div>
        </div>
      </section>
      <footer>
        <div className='container padding'>
          <div className='box logo'>
            <h1>ACADEMIA</h1>
            <span>ONLINE EDUCATION & LEARNING</span>
            <p>
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Beatae
              voluptate maiores corporis sint sit qui dolorum perspiciatis
              maxime commodi inventore!
            </p>

            <i className='fab fa-facebook-f icon'></i>
            <i className='fab fa-twitter icon'></i>
            <i className='fab fa-instagram icon'></i>
          </div>
          <div className='box link'>
            <h3>Explore</h3>
            <ul>
              <li>About Us</li>
              <li>Services</li>
              <li>Courses</li>
              <li>Blog</li>
              <li>Contact us</li>
            </ul>
          </div>
          <div className='box link'>
            <h3>Quick Links</h3>
            <ul>
              <li>Contact Us</li>
              <li>Pricing</li>
              <li>Terms & Conditions</li>
              <li>Privacy</li>
              <li>Feedbacks</li>
            </ul>
          </div>
          <div className='box'>
            <h3>Recent Post</h3>
            {blog.slice(0, 3).map((val, index) => (
              <div className='items flexSB' key={index}>
                <div className='img'>
                  <img src={val.cover} alt='' />
                </div>
                <div className='text'>
                  <span>
                    <i className='fa fa-calendar-alt'></i>
                    <label htmlFor=''>{val.date}</label>
                  </span>
                  <span>
                    <i className='fa fa-user'></i>
                    <label htmlFor=''>{val.type}</label>
                  </span>
                  <h4>{val.title.slice(0, 40)}...</h4>
                </div>
              </div>
            ))}
          </div>
          <div className='box last'>
            <h3>Have a Questions?</h3>
            <ul>
              <li>
                <i className='fa fa-map'></i>
                Jove Ilića 154, Belgrade, Serbia
              </li>
              <li>
                <i className='fa fa-phone-alt'></i>
                +381 60 3929 210
              </li>
              <li>
                <i className='fa fa-paper-plane'></i>
                lms@acedemia.com
              </li>
            </ul>
          </div>
        </div>
      </footer>
      <div className='legal'>
        <p>Copyright ©2024 All rights reserved</p>
      </div>
    </>
  );
};

export default Footer;
