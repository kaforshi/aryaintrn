from PIL import Image, ImageDraw

size = 256
img = Image.new("RGBA", (size, size), (255, 255, 255, 0))
draw = ImageDraw.Draw(img)

draw.rounded_rectangle((12, 12, size - 12, size - 12), radius=40, fill=(11, 23, 42, 255))
draw.line([(60, 160), (180, 100)], fill=(203, 161, 70, 255), width=20)
draw.line([(60, 160), (130, 190)], fill=(203, 161, 70, 255), width=20)
draw.polygon([(70, 60), (95, 60), (125, 170), (100, 170)], fill=(255, 255, 255, 255))
draw.polygon([(140, 60), (165, 60), (135, 170), (110, 170)], fill=(255, 255, 255, 255))
draw.rectangle((105, 120, 150, 140), fill=(11, 23, 42, 255))
draw.rectangle((150, 60, 185, 170), fill=(255, 255, 255, 255))
draw.pieslice((125, 140, 205, 220), 0, 180, fill=(255, 255, 255, 255))
draw.rectangle((125, 160, 205, 220), fill=(11, 23, 42, 255))
draw.ellipse((190, 40, 220, 70), fill=(203, 161, 70, 255))

img.save("public/favicon.png")
img.save("public/favicon.ico", sizes=[(256, 256), (128, 128), (64, 64), (32, 32), (16, 16)])


