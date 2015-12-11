(function() {
  window.translations || (window.translations = {});

  window.translations['datepicker'] = {
    start_from_sunday: 1,
    months: ["", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    short_months: ["", "Jan", "Feb", "Mar", "Apr", "Mar", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    days: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
    legend: {
      startDate: "Check in",
      endDate: "Check out"
    }
  };

}).call(this);

(function() {
  this.TpDatepickerMonthRenderer = (function() {
    TpDatepickerMonthRenderer.prototype.prefix = '';

    TpDatepickerMonthRenderer.prototype.marks = ['prev', 'current-date', 'next'];

    TpDatepickerMonthRenderer.prototype.isTouchDevice = null;

    function TpDatepickerMonthRenderer(callback, daysNames, sundayFirst, prefix, onlyFuture) {
      var ref;
      this.callback = callback;
      this.daysNames = daysNames;
      this.sundayFirst = sundayFirst;
      this.onlyFuture = onlyFuture;
      ref = this.marks, this.marksPrev = ref[0], this.marksCurrent = ref[1], this.marksNext = ref[2];
      this.isTouchDevice || (this.isTouchDevice = window.isTouchDevice);
      if (prefix) {
        this.prefix = prefix;
      }
    }

    TpDatepickerMonthRenderer.prototype.render = function(year, month, isCurrentMonth, isPrevMonth, currentDay) {
      return this._buildTable(this._monthDaysArray(year, month), isCurrentMonth, isPrevMonth, currentDay, month);
    };

    TpDatepickerMonthRenderer.prototype._firstDay = function(year, month) {
      return (new Date(year, month - 1, 1)).getDay();
    };

    TpDatepickerMonthRenderer.prototype._monthLength = function(year, month) {
      return 32 - new Date(year, month - 1, 32, 10).getDate();
    };

    TpDatepickerMonthRenderer.prototype._monthDaysArray = function(year, month) {
      var days, needShift, nextMonth, nextYear, prevMonth, prevMonthEnd, prevMonthLength, prevMonthStart, prevYear;
      nextYear = prevYear = year;
      days = [];
      needShift = true;
      if (month === 1) {
        prevYear--;
        prevMonth = 12;
        nextMonth = month + 1;
      } else if (month === 12) {
        nextYear++;
        nextMonth = 1;
        prevMonth = month - 1;
      } else {
        nextMonth = month + 1;
        prevMonth = month - 1;
      }
      prevMonthLength = this._monthLength(prevYear, prevMonth);
      prevMonthStart = prevMonthLength - this._firstDay(year, month) + 1 - this.sundayFirst;
      prevMonthEnd = prevMonthLength + 1;
      if (prevMonthStart === prevMonthEnd) {
        prevMonthStart = prevMonthStart - 6;
        needShift = false;
      }

    for (var day = prevMonthStart, fin = prevMonthEnd; day < fin; days.push([prevYear, prevMonth, day++, this.marksPrev]));
    for (var day = 1, fin = this._monthLength(year, month) + 1; day < fin; days.push([year, month, day++, this.marksCurrent]));
    for (var day = 1; day < 14; days.push([nextYear, nextMonth, day++, this.marksNext]));
    ;
      if (needShift) {
        days.shift();
      }
      return days;
    };

    TpDatepickerMonthRenderer.prototype._callbackProxy = function(event) {
      var target;
      target = event.target;
      if (target.tagName === 'DIV') {
        target = target.parentNode;
      }
      if (!(target.classList.contains(this.prefix + "tp-datepicker-prev-date") && this.onlyFuture)) {
        return target.hasAttribute('id') && this.callback(event.type, target);
      }
    };

    TpDatepickerMonthRenderer.prototype._buildTable = function(days, isCurrentMonth, isPrevMonth, currentDay, currentMonth) {
      var callbackProxy, cd, date, day, daysHash, el, i, id, innerEl, j, k, table, th;
      table = document.createElement('table');
      table.classList.add(this.prefix + "tp-datepicker-table");
      table.classList.add(this.prefix + "tp-datepicker-table--" + (this.sundayFirst ? 'sunday-first' : 'normal-weekdays'));
      callbackProxy = (function(_this) {
        return function(event) {
          return _this._callbackProxy(event);
        };
      })(this);
      table.addEventListener('click', callbackProxy);
      table.addEventListener('mouseout', callbackProxy);
      table.addEventListener('mouseover', callbackProxy);
      if (window.isTouchDevice) {
        table.addEventListener('touchstart', callbackProxy);
        table.addEventListener('touchend', callbackProxy);
        table.addEventListener('touchmove', callbackProxy);
      }
      th = table.appendChild(document.createElement('tr'));
      for (i = j = 0; j <= 6; i = ++j) {
        el = th.appendChild(document.createElement('td'));
        el.classList.add(this.prefix + "tp-datepicker-day_name");
        el.textContent = this.daysNames[i];
      }
      daysHash = {};
      for (i = k = 0; k < 42; i = ++k) {
        cd = days[i];
        if (i % 7 === 0) {
          el = table.appendChild(document.createElement('tr'));
        }
        date = cd[0] + "-" + cd[1] + "-" + cd[2];
        id = this.prefix + "tp-datepicker-" + date;
        day = daysHash[id] = el.appendChild(document.createElement('td'));
        innerEl = day.appendChild(document.createElement('div'));
        day.setAttribute('id', id);
        day.setAttribute('data-date', date);
        innerEl.textContent = cd[2];
        day.className = this.prefix + "tp-datepicker-" + cd[3];
        if (isPrevMonth || (isCurrentMonth && ((currentDay > cd[2] && currentMonth >= cd[1]) || cd[3] === this.marksPrev))) {
          day.className += " " + this.prefix + "tp-datepicker-prev-date";
        } else {
          day.className += " " + this.prefix + "tp-datepicker-current";
        }
      }
      this.days = daysHash;
      return table;
    };

    return TpDatepickerMonthRenderer;

  })();

}).call(this);

(function() {
  this.TpDatepickerPopupRenderer = (function() {
    TpDatepickerPopupRenderer.prototype.prefix = '';

    TpDatepickerPopupRenderer.prototype.node = false;

    TpDatepickerPopupRenderer.prototype.monthRenderer = null;

    TpDatepickerPopupRenderer.prototype.render = function() {
      var month, node, year;
      year = this.datepicker.year;
      month = this.datepicker.month;
      node = this.monthRenderer.render(year, month, this.datepicker.isCurrentMonth, this.datepicker.isPrevMonth, this.datepicker.currentDay);
      this.nodeClassList.toggle(this.prefix + "tp-datepicker--current_month", this.onlyFuture && this.datepicker.isCurrentMonth);
      this.updateMonth(this.datepicker.t.months[month] + " " + year);
      return this.datepickerContainerNode.replaceChild(node, this.datepickerContainerNode.childNodes[0]);
    };

    function TpDatepickerPopupRenderer(datepicker, listener, prefix) {
      var dayNames, headerNode, nextMonthNode, prevMonthNode, sundayFirst;
      this.datepicker = datepicker;
      if (prefix) {
        this.prefix = prefix;
      }
      this.onlyFuture = this.datepicker.onlyFuture;
      dayNames = this.datepicker.t.days;
      sundayFirst = this.datepicker.t.start_from_sunday;
      if (sundayFirst) {
        dayNames.unshift(dayNames.pop());
      }
      this.monthRenderer = new TpDatepickerMonthRenderer(listener, dayNames, sundayFirst, this.prefix, this.onlyFuture);
      this.node = document.createElement('div');
      this.nodeClassList = this.node.classList;
      this.nodeClassList.add(this.prefix + "tp-datepicker");
      this.nodeClassList.add(this.prefix + "tp-datepicker-" + this.datepicker.type);
      headerNode = document.createElement('div');
      headerNode.className = this.prefix + "tp-datepicker-header";
      prevMonthNode = document.createElement('span');
      prevMonthNode.className = this.prefix + "tp-datepicker-prev-month-control";
      prevMonthNode.setAttribute('role', 'tp-datepicker-prev');
      headerNode.appendChild(prevMonthNode);
      this.MonthNode = document.createElement('span');
      this.MonthNode.setAttribute('role', 'tp-datepicker-month');
      headerNode.appendChild(this.MonthNode);
      nextMonthNode = document.createElement('span');
      nextMonthNode.className = this.prefix + "tp-datepicker-next-month-control";
      nextMonthNode.setAttribute('role', 'tp-datepicker-next');
      headerNode.appendChild(nextMonthNode);
      this.node.appendChild(headerNode);
      this.datepickerContainerNode = document.createElement('div');
      this.datepickerContainerNode.className = this.prefix + "tp-datepicker-container";
      this.datepickerContainerNode.setAttribute('role', 'tp-datepicker-table-wrapper');
      this.datepickerContainerNode.appendChild(document.createElement('span'));
      this.node.appendChild(this.datepickerContainerNode);
      if (this.datepicker.legend) {
        this.legendNode = document.createElement('span');
        this.legendNode.className = this.prefix + "tp-datepicker-legend";
        this.legendNode.setAttribute('role', 'tp-datepicker-legend');
        this.node.appendChild(this.legendNode);
      }
      document.body.appendChild(this.node);
      this.node;
    }

    TpDatepickerPopupRenderer.prototype.updateMonth = function(text) {
      return this.MonthNode.textContent = text;
    };

    return TpDatepickerPopupRenderer;

  })();

}).call(this);


(function() {
  this.TpDatepicker = (function() {
    TpDatepicker.prototype.prefix = '';

    TpDatepicker.prototype.roles = [];

    TpDatepicker.prototype.role = null;

    TpDatepicker.prototype.wrapper = false;

    TpDatepicker.prototype.popupRenderer = false;

    TpDatepicker.prototype.today = new Date();

    TpDatepicker.prototype.isCurrentMonth = false;

    TpDatepicker.prototype.t = window.translations.datepicker;

    TpDatepicker.prototype.isTouchDevice = window.isTouchDevice;

    TpDatepicker.prototype.nodes = [];

    TpDatepicker.prototype.settedRoles = false;

    TpDatepicker.prototype.legend = false;

    TpDatepicker.prototype.type = 'simple';

    TpDatepicker.prototype.onlyFuture = true;

    TpDatepicker.prototype.offsets = {
      top: 0,
      left: 0
    };

    TpDatepicker.prototype.onSelect = function(date, role) {
      return console.log(role + " selected date " + date);
    };

    function TpDatepicker(options) {
      var i, len, node, ref, role;
      if (options == null) {
        options = {};
      }
      this.datepickerWrapper = options.wrapper || document.body;
      this.roles = (options.role && [options.role]) || options.roles || ['tp-datepicker'];
      this.role = this.roles[0];
      if (options.callback) {
        this.onSelect = options.callback;
      }
      if (options.prefix) {
        this.prefix = options.prefix;
      }
      if (options.offsets) {
        this.offsets = options.offsets;
      }
      ref = this.roles;
      for (i = 0, len = ref.length; i < len; i++) {
        role = ref[i];
        node = this.nodes[role] = this.datepickerWrapper.querySelector("[role=\"" + role + "\"]");
        node.classList.add(this.prefix + "tp-datepicker-trigger");
        this[role] = this._parseDate(node.getAttribute('data-date'));
        node.setAttribute('readonly', true);
        node.addEventListener('focus', this._listenerFor(role));
        node.addEventListener('keydown', (function(_this) {
          return function(event) {
            return _this._processKey(event.keyCode);
          };
        })(this));
      }
      this._initPopup();
    }

    TpDatepicker.prototype._initPopup = function() {
      var listener;
      this.currentMonth = this.today.getMonth() + 1;
      this.currentYear = this.today.getFullYear();
      this.currentDay = this.today.getDate();
      listener = (function(_this) {
        return function(event_name, element) {
          return _this._callback_proxy(event_name, element);
        };
      })(this);
      this.popupRenderer = new TpDatepickerPopupRenderer(this, listener, this.prefix);
      if (window.SwipeDetector) {
        new SwipeDetector(this.popupRenderer.node, {
          left: (function(_this) {
            return function() {
              return _this.nextMonth();
            };
          })(this),
          right: (function(_this) {
            return function() {
              return _this.prevMonth();
            };
          })(this),
          down: (function(_this) {
            return function() {
              return _this.popupRenderer.node.classList.remove(_this.prefix + "tp-datepicker--active");
            };
          })(this),
          up: (function(_this) {
            return function() {
              return _this.popupRenderer.node.classList.remove(_this.prefix + "tp-datepicker--active");
            };
          })(this)
        });
      }
      this.popupRenderer.node.querySelector('[role="tp-datepicker-prev"]').addEventListener('click', (function(_this) {
        return function() {
          return _this.prevMonth();
        };
      })(this));
      this.popupRenderer.node.querySelector('[role="tp-datepicker-next"]').addEventListener('click', (function(_this) {
        return function() {
          return _this.nextMonth();
        };
      })(this));
      return document.addEventListener('click', (function(_this) {
        return function(event) {
          var node;
          if (!(node = event.target)) {
            return;
          }
          if (node.tagName !== 'BODY' && node.tagName !== 'HTML') {
            if (_this.roles.indexOf(node.getAttribute('role')) >= 0) {
              return;
            }
            while (node = node.parentNode) {
              if (node.tagName === 'BODY') {
                break;
              }
              if (!node.parentNode || node.classList.contains(_this.prefix + "tp-datepicker") || _this.roles.indexOf(node.getAttribute('role')) >= 0) {
                return;
              }
            }
          }
          _this.nodes[_this.role].classList.remove(_this.prefix + "tp-datepicker-trigger--active");
          return _this.popupRenderer.node.classList.remove(_this.prefix + "tp-datepicker--active");
        };
      })(this));
    };

    TpDatepicker.prototype._processKey = function(code) {
      switch (code) {
        case 27:
        case 9:
          this.popupRenderer.node.classList.remove(this.prefix + "tp-datepicker--active");
          return this.nodes[this.role].classList.remove(this.prefix + "tp-datepicker-trigger--active");
        case 8:
          return this.nodes[this.role].setAttribute('value', '');
      }
    };

    TpDatepicker.prototype.prevMonth = function() {
      if (this.onlyFuture && this.isCurrentMonth) {
        return;
      }
      if (this.month === 1) {
        this.year--;
        this.month = 12;
      } else {
        this.month--;
      }
      return this._renderDatepicker();
    };

    TpDatepicker.prototype.nextMonth = function() {
      if (this.month === 12) {
        this.year++;
        this.month = 1;
      } else {
        this.month++;
      }
      return this._renderDatepicker();
    };

    TpDatepicker.prototype.show = function(role1, callback) {
      var node, ref, role;
      this.role = role1;
      this.callback = callback;
      this.date = this._parseDate(this[this.role]) || this.today;
      this.month = this.date.getMonth() + 1;
      this.year = this.date.getFullYear();
      this._renderDatepicker();
      ref = this.nodes;
      for (role in ref) {
        node = ref[role];
        if (this.roles.indexOf(role) > -1) {
          node.classList.toggle(this.prefix + "tp-datepicker-trigger--active", role === this.role);
        }
      }
      if (window.positionManager) {
        return window.positionManager.positionAround(this.nodes[this.role], this.popupRenderer.node, false, this.offsets);
      }
    };

    TpDatepicker.prototype._callback_proxy = function(event_name, element) {
      switch (event_name) {
        case 'click':
          this.callback(element.getAttribute('data-date'));
          return true;
        default:
          return false;
      }
    };

    TpDatepicker.prototype._listenerFor = function(role) {
      return (function(_this) {
        return function(event) {
          _this.show(role, function(date) {
            return _this._showCallback(date, role);
          });
          if (_this.isTouchDevice) {
            event.preventDefault();
            return event.target.blur();
          }
        };
      })(this);
    };

    TpDatepicker.prototype._showCallback = function(date, role) {
      if (date) {
        this[role] = date;
      }
      this._setupDate(role, this[role]);
      if (!this.settedRoles) {
        this.nodes[this.role].classList.remove(this.prefix + "tp-datepicker-trigger--active");
        this.popupRenderer.node.classList.remove(this.prefix + "tp-datepicker--active");
        return this.onSelect(date, role);
      }
    };

    TpDatepicker.prototype._setupDate = function(role, date) {
      this.nodes[role].setAttribute('data-date', date);
      return this.nodes[role].setAttribute('value', this._formatDate(date));
    };

    TpDatepicker.prototype._renderDatepicker = function() {
      this.isCurrentMonth = this.currentYear === this.year && this.currentMonth === this.month;
      this.isPrevMonth = this.currentYear > this.year || (this.currentYear === this.year && this.currentMonth > this.month);
      this.popupRenderer.render(this);
      return this.popupRenderer.node.classList.add(this.prefix + "tp-datepicker--active");
    };

    TpDatepicker.prototype._parseDate = function(string) {
      var array;
      if (!string) {
        return;
      }
      array = string.split('-');
      return new Date(array[0], parseInt(array[1], 10) - 1, array[2]);
    };

    TpDatepicker.prototype._stringifyDate = function(date) {
      return (date.getFullYear()) + "-" + (date.getMonth() + 1) + "-" + (date.getDate());
    };

    TpDatepicker.prototype._formatDate = function(string) {
      var dateArray;
      if (!string) {
        return;
      }
      dateArray = string.split('-');
      return dateArray[2] + " " + (this.t.short_months[parseInt(dateArray[1], 10)].toLowerCase()) + " " + dateArray[0];
    };

    TpDatepicker.prototype._setScale = function(value, element) {
      if (element == null) {
        element = this.popupRenderer.node;
      }
      return element.style.webkitTransform = element.style.transform = "scale(" + value + ")";
    };

    return TpDatepicker;

  })();

}).call(this);


(function() {
  var extend = function(child, parent) { for (var key in parent) { if (hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
    hasProp = {}.hasOwnProperty;

  this.TpDatepickerRange = (function(superClass) {
    extend(TpDatepickerRange, superClass);

    TpDatepickerRange.prototype.isEndDate = false;

    TpDatepickerRange.prototype.settedRoles = {};

    TpDatepickerRange.prototype.prevRole = false;

    TpDatepickerRange.prototype.readyToDraw = true;

    TpDatepickerRange.prototype.legend = false;

    TpDatepickerRange.prototype.type = 'range';

    TpDatepickerRange.prototype.onSelect = function(startDate, endDate, role) {
      return console.log(role + " selected range from " + startDate + " to " + endDate);
    };

    function TpDatepickerRange(options) {
      var ref;
      if (options == null) {
        options = {};
      }
      options.role = null;
      options.roles || (options.roles = ['startDate', 'endDate']);
      if (options.legend) {
        this.legend = options.legend;
      }
      TpDatepickerRange.__super__.constructor.call(this, options);
      ref = this.roles, this.startDateRole = ref[0], this.endDateRole = ref[1];
      this.settedRoles[this.startDateRole] = this.settedRoles[this.endDateRole] = false;
    }

    TpDatepickerRange.prototype.show = function(role1, callback) {
      this.role = role1;
      this.callback = callback;
      this.isEndDate = this.role === this.endDateRole;
      TpDatepickerRange.__super__.show.call(this, this.role, this.callback);
      return this.prevRole = this.role;
    };

    TpDatepickerRange.prototype._callback_proxy = function(event_name, element) {
      if (TpDatepickerRange.__super__._callback_proxy.call(this, event_name, element)) {
        return true;
      }
      switch (event_name) {
        case 'mouseout':
          this.readyToDraw = true;
          return true;
        case 'mouseover':
          if (!this.readyToDraw) {
            return;
          }
          if (this.isEndDate) {
            this._drawSausage(this.startDate, element.getAttribute('data-date'));
          } else {
            this._drawSausage(element.getAttribute('data-date'), this.endDate);
          }
          this.readyToDraw = false;
          return true;
        default:
          return false;
      }
    };

    TpDatepickerRange.prototype._currentDateType = function() {
      if (this.isEndDate) {
        return 'endDate';
      } else {
        return 'startDate';
      }
    };

    TpDatepickerRange.prototype._showCallback = function(date, role) {
      var oppositeRole;
      TpDatepickerRange.__super__._showCallback.call(this, date, role);
      if (date) {
        this[this._currentDateType()] = date;
      }
      this.settedRoles[role] = true;
      this._checkDates(role);
      oppositeRole = this._oppositeRole(role);
      if (this.settedRoles[oppositeRole]) {
        this.nodes[this.role].classList.remove(this.prefix + "tp-datepicker-trigger--active");
        this.popupRenderer.node.classList.remove(this.prefix + "tp-datepicker--active");
      } else {
        this._setupDate(oppositeRole, this[oppositeRole]);
        this._listenerFor(oppositeRole)();
      }
      return this.onSelect(this.startDateObj, this.endDateObj, role);
    };

    TpDatepickerRange.prototype._oppositeRole = function() {
      if (this.isEndDate) {
        return this.startDateRole;
      } else {
        return this.endDateRole;
      }
    };

    TpDatepickerRange.prototype._checkDates = function(role) {
      var oppositeRole;
      this.startDateObj = this._parseDate(this.startDate) || (this.endDateObj && this._changeDate(this.endDateObj, -1)) || this.today;
      this.endDateObj = this._parseDate(this.endDate) || (this.startDateObj && this._changeDate(this.startDateObj, 1));
      oppositeRole = this._oppositeRole(role);
      if (this.startDateObj >= this.endDateObj || !this.settedRoles[oppositeRole] || this.endDateObj === this.today) {
        this.settedRoles[oppositeRole] = false;
        if (this.isEndDate) {
          if (this.endDateObj === this.today) {
            this.endDateObj = this._changeDate(this.today, 1);
          }
          this.startDateObj = this._changeDate(this.endDateObj, -1);
        } else {
          this.endDateObj = this._changeDate(this.startDateObj, 1);
        }
      }
      this.startDate = this[this.startDateRole] = this._stringifyDate(this.startDateObj);
      return this.endDate = this[this.endDateRole] = this._stringifyDate(this.endDateObj);
    };

    TpDatepickerRange.prototype._renderDatepicker = function() {
      TpDatepickerRange.__super__._renderDatepicker.call(this);
      this._drawSausage(this.startDate, this.endDate);
      if (this.legend && this.prevRole !== this.role) {
        return this._updateLegend(this.t.legend[this._currentDateType()]);
      }
    };

    TpDatepickerRange.prototype._updateLegend = function(text) {
      var node;
      node = this.popupRenderer.legendNode;
      node.textContent = text;
      node.classList.toggle(this.prefix + "tp-datepicker-legend--start-date", !this.isEndDate);
      node.classList.toggle(this.prefix + "tp-datepicker-legend--end-date", this.isEndDate);
      this._setScale(1.1, node);
      return setTimeout(((function(_this) {
        return function() {
          return _this._setScale(1, node);
        };
      })(this)), 200);
    };

    TpDatepickerRange.prototype._drawSausage = function(sausageStart, sausageEnd) {
      var arrayEnd, arrayStart, classList, date, ended, isEnding, isStarting, node, ref, results, samePoints, started;
      if (!(sausageStart || sausageEnd)) {
        return;
      }
      sausageStart || (sausageStart = sausageEnd);
      sausageEnd || (sausageEnd = sausageStart);
      arrayStart = sausageStart.split('-');
      arrayEnd = sausageEnd.split('-');
      started = parseInt(arrayStart[1], 10) < this.month && parseInt(arrayEnd[1], 10) >= this.month;
      ended = parseInt(arrayEnd[1], 10) < this.month && parseInt(arrayStart[1], 10) >= this.month;
      sausageStart = this.prefix + "tp-datepicker-" + sausageStart;
      sausageEnd = this.prefix + "tp-datepicker-" + sausageEnd;
      samePoints = sausageStart === sausageEnd;
      ref = this.popupRenderer.monthRenderer.days;
      results = [];
      for (date in ref) {
        node = ref[date];
        classList = node.classList;
        if (!(this.onlyFuture && classList.contains(this.prefix + "tp-datepicker-prev-date"))) {
          isStarting = sausageStart === date;
          isEnding = sausageEnd === date;
          if (isStarting && !((samePoints || ended) && this.isEndDate)) {
            classList.add(this.prefix + "tp-datepicker-start-sausage");
            classList.remove(this.prefix + "tp-datepicker-range");
            classList.remove(this.prefix + "tp-datepicker-end-sausage");
            classList.remove(this.prefix + "tp-datepicker-end-sausage--invisible");
            classList.remove(this.prefix + "tp-datepicker-start-sausage--invisible");
            started = !samePoints;
            if (started && !ended) {
              results.push(classList.add(this.prefix + "tp-datepicker-range"));
            } else {
              results.push(void 0);
            }
          } else if (isEnding && (started || this.isEndDate)) {
            classList.add(this.prefix + "tp-datepicker-end-sausage");
            classList.remove(this.prefix + "tp-datepicker-range");
            classList.remove(this.prefix + "tp-datepicker-start-sausage");
            classList.remove(this.prefix + "tp-datepicker-end-sausage--invisible");
            classList.remove(this.prefix + "tp-datepicker-start-sausage--invisible");
            if (started) {
              classList.add(this.prefix + "tp-datepicker-range");
            }
            started = samePoints;
            results.push(ended = true);
          } else if (started && !ended) {
            classList.add(this.prefix + "tp-datepicker-range");
            classList.remove(this.prefix + "tp-datepicker-start-sausage");
            results.push(classList.remove(this.prefix + "tp-datepicker-end-sausage"));
          } else {
            if (isEnding) {
              ended = true;
              classList.add(this.prefix + "tp-datepicker-end-sausage--invisible");
              classList.remove(this.prefix + "tp-datepicker-start-sausage--invisible");
            } else if (isStarting) {
              classList.add(this.prefix + "tp-datepicker-start-sausage--invisible");
              classList.remove(this.prefix + "tp-datepicker-end-sausage--invisible");
            } else {
              classList.remove(this.prefix + "tp-datepicker-start-sausage--invisible");
              classList.remove(this.prefix + "tp-datepicker-end-sausage--invisible");
            }
            classList.remove(this.prefix + "tp-datepicker-range");
            classList.remove(this.prefix + "tp-datepicker-start-sausage");
            results.push(classList.remove(this.prefix + "tp-datepicker-end-sausage"));
          }
        } else {
          results.push(void 0);
        }
      }
      return results;
    };

    TpDatepickerRange.prototype._changeDate = function(date, step) {
      if (step == null) {
        step = 1;
      }
      return new Date((new Date(date)).setDate(date.getDate() + step));
    };

    return TpDatepickerRange;

  })(TpDatepicker);

}).call(this);


(function() {
  window.isTouchDevice = window.ontouchstart || navigator.MaxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;

  this.SwipeDetector = (function() {
    SwipeDetector.prototype.xDown = null;

    SwipeDetector.prototype.yDown = null;

    SwipeDetector.prototype.wrapper = null;

    SwipeDetector.prototype.callbacks = {};

    SwipeDetector.prototype.sensivity = 50;

    SwipeDetector.prototype.xDiff = 0;

    SwipeDetector.prototype.yDiff = 0;

    SwipeDetector.prototype.blockScroll = false;

    function SwipeDetector(wrapper, callbacks, sensivity) {
      this.wrapper = wrapper != null ? wrapper : document.body;
      this.callbacks = callbacks != null ? callbacks : {};
      this.sensivity = sensivity != null ? sensivity : 10;
      this.wrapper.addEventListener('touchstart', ((function(_this) {
        return function(e) {
          return _this.handleTouchStart(e);
        };
      })(this)), false);
      this.wrapper.addEventListener('touchend', ((function(_this) {
        return function(e) {
          return _this.handleTouchEnd(e);
        };
      })(this)), false);
      this.wrapper.addEventListener('touchmove', ((function(_this) {
        return function(e) {
          return _this.handleTouchMove(e);
        };
      })(this)), false);
    }

    SwipeDetector.prototype.handleTouchStart = function(event) {
      this.blockScroll = true;
      this.xDown = event.touches[0].clientX;
      return this.yDown = event.touches[0].clientY;
    };

    SwipeDetector.prototype.handleTouchEnd = function(event) {
      this.blockScroll = false;
      if (Math.abs(this.xDiff) > Math.abs(this.yDiff)) {
        if (Math.abs(Math.abs(this.xDiff) - Math.abs(this.yDiff)) > this.sensivity) {
          if (this.xDiff > 0) {
            this.callbacks.left && this.callbacks.left();
          } else {
            this.callbacks.right && this.callbacks.right();
          }
        }
      } else {
        if (Math.abs(Math.abs(this.yDiff) - Math.abs(this.xDiff)) > this.sensivity) {
          if (this.yDiff > 0) {
            this.callbacks.up && this.callbacks.up();
          } else {
            this.callbacks.down && this.callbacks.down();
          }
        }
      }
      this.xDown = null;
      this.yDown = null;
      this.xDiff = 0;
      return this.yDiff = 0;
    };

    SwipeDetector.prototype.handleTouchMove = function(event) {
      var xUp, yUp;
      if (this.blockScroll) {
        event.preventDefault();
      }
      if (!(this.xDown && this.yDown)) {
        return;
      }
      xUp = event.touches[0].clientX;
      yUp = event.touches[0].clientY;
      this.xDiff += this.xDown - xUp;
      this.yDiff += this.yDown - yUp;
      this.xDown = xUp;
      return this.yDown = yUp;
    };

    return SwipeDetector;

  })();

}).call(this);


(function() {
  window.positionManager = {
    positionAround: function(targetNode, sourceNode, forcedBottom, offsets) {
      var bodyRect, bottomSpace, showBottom, targetHeight, targetPosition, targetRect;
      if (forcedBottom == null) {
        forcedBottom = false;
      }
      if (offsets == null) {
        offsets = {
          top: 0,
          left: 0
        };
      }
      sourceNode.style.position = 'absolute';
      bodyRect = document.body.getBoundingClientRect();
      targetRect = targetNode.getBoundingClientRect();
      targetPosition = this._getOffset(targetNode);
      targetHeight = targetNode.offsetHeight;
      bottomSpace = document.documentElement.clientHeight - targetRect.bottom;
      showBottom = forcedBottom || bottomSpace > sourceNode.offsetHeight;
      if (!showBottom) {
        showBottom = bottomSpace > targetRect.top;
      }
      if (showBottom) {
        sourceNode.style.top = (targetPosition.top + targetHeight + document.body.scrollTop + offsets.top) + "px";
        return sourceNode.style.left = (targetPosition.left + document.body.scrollLeft + offsets.left) + "px";
      } else {
        sourceNode.style.top = (targetPosition.top - sourceNode.offsetHeight + document.body.scrollTop - offsets.top) + "px";
        return sourceNode.style.left = (targetPosition.left + document.body.scrollLeft + offsets.left) + "px";
      }
    },
    _getOffset: function(el) {
      var _x, _y;
      _x = _y = 0;
      while (el && !isNaN(el.offsetLeft) && !isNaN(el.offsetTop)) {
        _x += el.offsetLeft - el.scrollLeft;
        _y += el.offsetTop - el.scrollTop;
        el = el.offsetParent;
      }
      return {
        top: _y,
        left: _x
      };
    }
  };

}).call(this);
