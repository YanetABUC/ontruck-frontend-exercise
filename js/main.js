let main = new Vue({
  el: '#vcontainer',
  data: {
    vehicles: [],
    drivers: [],
    items: [],
    descMode: true,
    activeFilter: 'all',
    activeSearch: '',
    truckSizes: {
      full_trailer: 4,
      rigid_truck: 3,
      box_van: 2,
      van: 1
    }
  },
  methods: {
    init() {
      let self = this
      let xhr = new XMLHttpRequest()
      xhr.onload = function () {
        let data = JSON.parse(this.responseText)

        if (this.status == 200) {
          self.vehicles = data
          self.getDrivers()
        }
      }

      xhr.open('GET', 'http://localhost:3000/vehicles')
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
      xhr.send()
    },
    getDrivers(result) {
      let self = this;
      let xhr = new XMLHttpRequest()
      xhr.onload = function () {
        let data = JSON.parse(this.responseText)

        if (this.status == 200) {
          self.drivers = data
          self.processData()
        }
      }
      xhr.open('GET', 'http://localhost:3000/drivers')
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
      xhr.send()
    },
    order(descMode) {
      this.descMode = descMode
      this.processData()
    },
    query() {
      let searcherEl= document.getElementById('searcher')
      this.activeSearch = searcherEl.value.toLowerCase()
      this.processData()
    },
    filterBy(truckType) {
      this.activeFilter = truckType
      this.processData()
    },
    getTruckSize(truckSize) {
      switch(truckSize) {
        case 'full_trailer': return this.truckSizes.full_trailer
        case 'rigid_truck': return this.truckSizes.rigid_truck
        case 'box_van': return this.truckSizes.box_van
        case 'van': return this.truckSizes.van
      }
    },
    getTruckIconCsClass(truckSize) {
      switch(truckSize) {
        case 'full_trailer': return 'icon-full-trailer'
        case 'rigid_truck': return 'icon-rigid-truck'
        case 'box_van': return 'icon-box-van'
        case 'van': return 'icon-van'
      }
    },
    sort() {
      let self = this

      self.items = self.items.sort((a, b) => {
        if(a.size == b.size) {
          if(self.descMode) {
            return b.driversTotal - a.driversTotal
          } else {
            return a.driversTotal - b.driversTotal
          }
        }
        return b.size - a.size
      })
    },
    search() {
      let self = this
      if(self.activeSearch !== '') {
        self.items = self.items.filter((elem) => {
          return elem.drivers.find((el) => {
            return el.name.toLowerCase().includes(self.activeSearch) ||
              el.email.toLowerCase().includes(self.activeSearch)
          })
        })
      }
    },
    filter() {
      let self = this

      if(self.activeFilter !== 'all') {
        self.items = self.items.filter((elem) => {
          return elem.type === self.activeFilter
        })
      }
    },
    processData() {
      let self = this
      self.items = []
      
      self.vehicles.forEach(function(item) {
        let drivers = self.drivers.filter((elem) => {
          return elem.vehicles.find(function(el) {
            return el == item.id
          })
        });
        
        self.items.push({
          'icon': self.getTruckIconCsClass(item.type),
          'type': item.type,
          'size': self.getTruckSize(item.type),
          'drivers': drivers,
          'driversTotal': drivers.length
        });
      })

      self.search()
      self.filter()
      self.sort()
    }
  },
  created() {
    this.init()
  }
});