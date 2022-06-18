const localStore = Object.create(null, {
  set: {
    value: (key, itemValue) => {
      try {
        return window.localStorage && window.localStorage.setItem(key, JSON.stringify(itemValue))
      } catch (error) {
        console.error(error)
      }
    },
  },
  get: {
    value: key => {
      const itemValue = window.localStorage && window.localStorage.getItem(key)
      try {
        return JSON.parse(itemValue)
      } catch (error) {
        console.error(error)
      }
    },
  },
  remove: {
    value: (key) => {
      try {
        return window.localStorage && window.localStorage.removeItem(key)
      } catch (error) {
        console.error(error)
      }
    },
  },
  clear: {
    value: () => {
      try {
        return window.localStorage && window.localStorage.clear()
      } catch (error) {
        console.error(error)
      }
    },
  },
})

export default localStore;