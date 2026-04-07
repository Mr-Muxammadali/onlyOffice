FROM node:22

WORKDIR /app

# dependencies
COPY package*.json ./
RUN npm install

# source
COPY . .

# build
RUN npm run build

# default command (agar kerak bo‘lsa)
CMD ["npm", "run", "dev"]
