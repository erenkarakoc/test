"use client"

import Image from "next/image"
import Button from "../ui/Button/Button"

import { motion } from "framer-motion"

export default function Hero() {
  const firstLine = "From developers,"
  const secondLine = "for traders."

  const heroLetterAnimation = {
    hidden: {
      top: -10,
      opacity: 0,
    },
    visible: (i: number) => ({
      top: 0,
      opacity: 1,
      transition: { delay: i * 0.03 },
    }),
  }
  return (
    <div
      className="justify-items-center h-[200vh]"
      id="gdz-hero"
    >
      <div className="relative overflow-hidden flex justify-between items-center bg-black border border-black-200 w-full p-20 rounded-xl">
        <iframe
          src="https://my.spline.design/boxeshover-8253465a9b82c63ccc6f65f50d2f5f79/"
          className="absolute top-0 left-0 w-full h-full select-none z-1"
          height={1000}
          width={1000}
        />

        <div className="flex flex-col gap-4 relative z-10 pointer-events-none">
          <h1 className="font-mono text-4xl font-black text-center mb-0">
            {firstLine.split("").map((char, index) => (
              <motion.span
                key={`${char}-${index}`}
                custom={index}
                variants={heroLetterAnimation}
                initial="hidden"
                animate="visible"
                className="relative"
              >
                {char}
              </motion.span>
            ))}
            {secondLine.split("").map((char, index) => (
              <motion.span
                key={`${char}-${index}`}
                custom={index + firstLine.length}
                variants={heroLetterAnimation}
                initial="hidden"
                animate="visible"
                className="relative"
              >
                {char}
              </motion.span>
            ))}
          </h1>
          <motion.p
            className="font-sans text-gray-500 text-sm mt-6 mb-0"
            initial={{ opacity: 0, y: 10 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 1 }}
          >
            Experience latest algorithmic trading technologies
            <br />
            with a super simple user interface.
          </motion.p>

          <motion.div
            initial={{ opacity: 0, y: 10 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 1.4 }}
            className="mt-6"
          >
            <Button link="#">Explore</Button>
          </motion.div>
        </div>
      </div>
    </div>
  )
}
