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
      <div className="flex justify-between items-center bg-black border border-black-200 w-full p-20 rounded-xl">
        <div className="flex flex-col gap-4 ">
          <h1 className="font-mono text-4xl font-black text-left mb-0">
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
            <br />
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
          <p className="font-sans text-gray-500 text-sm mt-6 mb-0">
            Experience latest algorithmic trading technologies
            <br />
            with a super simple user interface.
          </p>

          <Button
            link="#"
            className="mt-6"
          >
            Explore
          </Button>
        </div>

        <Image
          src="/assets/img/home/swift.png"
          alt="Swift"
          width={300}
          height={300}
          draggable={false}
          className="select-none"
        />
      </div>
    </div>
  )
}
