import React from 'react';
import request from 'superagent';
import debounce from 'lodash.debounce';

class InfiniteSpace extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      error: false,
      hasMore: true,
      isLoading: false,
      apods: []
    };

    window.onscroll = debounce(() => {
      const {
        loadApods,
        state: {
          error,
          isLoading,
          hasMore,
        },
      } = this;

      if (error || isLoading || !hasMore) return;

      if (window.innerHeight + document.documentElement.scrollTop === document.documentElement.offsetHeight) {
        loadApods();
      }
    }, 100);
  }

  componentDidMount() {
    this.loadApods();
  }

  dayOffset = () => {
    let today = new Date();
    let day = today.setDate(-1 * this.state.apods.length);
    return new Date(day).toISOString().split('T')[0];
  }

  loadApods = () => {this.setState({ isLoading: true }, () => {
    request
      .get('https://api.nasa.gov/planetary/apod?date=' + this.dayOffset() + '&api_key=DEMO_KEY')
      .then((results) => {
        const nextApod = {
          date: results.body.date,
          title: results.body.title,
          explanation: results.body.explanation,
          copyright: results.body.copyright,
          media_type: results.body.media_type,
          url: results.body.url
        };

        this.setState({
          hasMore: (this.state.apods.length < 5),
          isLoading: false,
          apods: [
            ...this.state.apods,
            nextApod
          ],
        });
      })
      .catch((err) => {
        this.setState({
          error: err.message,
          isLoading: false
        });
      });
    });
  }

  render() {
    const {
      error,
      hasMore,
      isLoading,
      apods
    } = this.state;

    return (
      <div style={{
        padding: 10
      }}>
        <h1>Infinite Space!</h1>
        <p>Scroll down to load more!!</p>

        {apods.map(apod => (
          <React.Fragment key={apod.date}>
            <hr />
            <div>
              <h2>{apod.title}</h2>
              {apod.media_type === 'image' &&
                <img
                  alt={`NASA APOD for {apod.date}`}
                  src={apod.url}
                  style={{
                    maxWidth: '100%',
                    height: 'auto'
                  }}
                />
              }
              {apod.media_type === 'video' &&
                <iframe
                  title='test'
                  src={apod.url}
                  width='640'
                  height='360'
                  style={{
                    maxWidth: '100%'
                  }}
                ></iframe>
              }
              <div>{apod.explanation}</div>
              <div>{apod.copyright}</div>
            </div>
          </React.Fragment>
        ))}

        <hr />

        {error &&
          <div style={{ color: '#900' }}>
            {error}
          </div>
        }

        {isLoading &&
          <div>Loading...</div>
        }

        {!hasMore &&
          <div>Loading Complete</div>
        }
      </div>
    );
  }
}

export default InfiniteSpace;